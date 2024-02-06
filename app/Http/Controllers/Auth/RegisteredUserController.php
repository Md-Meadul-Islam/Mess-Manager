<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\validationPhone;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', new validationPhone, 'unique:' . User::class],
            'photo' => ['image', 'mimes:jpg,jpeg,png', 'dimensions:max_width=1000,max_height=1000'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $flattenedErrors = Arr::flatten($errors);
            return back()->with('errors', $flattenedErrors);
        } else {
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
                    'created_at' => now(),
                ]);
                event(new Registered($user));
                session()->put('dates', now()->format('M-Y'));
                Auth::login($user);
                return redirect()->route('manager_mate.dashboard')->with('success', 'Manager Account Created Successfully !');
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
                    'created_at' => now(),
                ]);
                event(new Registered($user));
                session()->put('dates', now()->format('M-Y'));
                Auth::login($user);
                return redirect()->route('manager_mate.dashboard')->with('success', 'Member Account Created Successfully !');
            } else {
                return redirect()->route('register')->with('error', 'Cannot Create this Account !');
            }
        }
    }
}
