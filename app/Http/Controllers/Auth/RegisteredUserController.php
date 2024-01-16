<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

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
            'phone' => ['required', 'string', 'max:15', 'min:8', 'regex:/^[0-9\(\)\-\s]*$/', 'unique:' . User::class],
            'photo' => ['image', 'mimes:jpg,jpeg,png', 'dimensions:max_width=1000,max_height=1000'],
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
        $DateNow = now()->format('Ymd');
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
                'create_at' => $DateNow,
                'update_at' => $DateNow,
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
                'create_at' => $DateNow,
                'update_at' => $DateNow,
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
