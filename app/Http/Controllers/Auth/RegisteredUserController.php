<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'unique:' . User::class],
            'photo' => ['mimes:jpg,jpeg,png'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $image = $request->file('photo');
        if (isset($image)) {
            $imageName = time() . '.' . $request->photo->getClientOriginalExtension();
            if (!file_exists('uploads/profile_img')) {
                mkdir('uploads/profile_img', 077, true);
            }
            $image->move('uploads/profile_img', $imageName);
        } else {
            $imageName = 'default.png';
        }
        $findingRole = User::where('role', 'manager')->where('batch', $request->phone2)->first();
        if ($request->role === 'manager') {
            $user = User::create([
                'name' => $request->name,
                'username' => str_slug($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'photo' => $imageName,
                'password' => Hash::make($request->password),
                'batch' => $request->phone,
            ]);
            event(new Registered($user));
            session()->put('dates', now()->format('M-Y'));
            Auth::login($user);
            return redirect()->route('manager_mate.dashboard');
        } elseif ($request->role === 'mate' && $findingRole) {
            $user = User::create([
                'name' => $request->name,
                'username' => str_slug($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'photo' => $imageName,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'batch' => $request->phone2,
            ]);
            event(new Registered($user));
            session()->put('dates', now()->format('M-Y'));
            Auth::login($user);
            return redirect()->route('manager_mate.dashboard');
        } else {
            return redirect()->route('register');
        }
    }
}
