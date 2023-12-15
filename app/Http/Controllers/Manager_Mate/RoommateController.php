<?php

namespace App\Http\Controllers\Manager_Mate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RoommateController extends Controller
{
    protected $batch;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->batch = Auth::user()->batch;
            }

            return $next($request);
        });
    }
    public function index()
    {
        if (session('dates') == now()->format('M-Y')) {
            $mates = User::where('batch', $this->batch)->where('role', 'mate')->where('status', 'active')->get();
        } elseif (session('dates') > now()->format('M-Y')) {
            $sessionDate = Carbon::createFromFormat('M-Y', session('dates'));
            $mate = User::where('batch', $this->batch)->where('role', 'mate');
            $mates = $mate->where(function ($query) use ($sessionDate) {
                $query->whereMonth('created_at', '<', $sessionDate->month)
                    ->orWhere(function ($query) use ($sessionDate) {
                        $query->whereMonth('created_at', $sessionDate->month)
                            ->whereYear('created_at', $sessionDate->year);
                    });
            })->get();
        } else {
            $mates = null;
        }
        return view('manager_mate.roommate_table.index', compact('mates'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'unique:' . User::class],
            'photo' => ['mimes:jpg,jpeg,png'],
            'password' => ['required', 'confirmed', Password::defaults()],
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
        $batch = Auth::user()->phone;

        $user = User::create([
            'name' => $request->name,
            'username' => str_slug($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $imageName,
            'phone' => $request->phone,
            'role' => 'mate',
            'batch' => $batch,
        ]);

        event(new Registered($user));
        return redirect()->route('roommates.index');
    }
    public function edit(string $id)
    {
        if (Auth::user()->role === 'manager') {
            $mates = User::where('batch', $this->batch)->where('id', $id)->first();
        }
        return view('manager_mate.roommate_table.edit', compact('mates'));
    }
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'name' => ['max:25'],
        //     'email' => ['string', 'lowercase', 'email', 'max:55', 'unique:' . User::class],
        //     'phone' => ['string', 'unique:' . User::class],
        //     'photo' => ['mimes:jpg,jpeg,png'],
        // ]);
        $mates = User::find($id);
        $image = $request->file('photo');
        if (isset($image)) {
            $imageName = time() . '.' . $request->photo->getClientOriginalExtension();
            if (!file_exists('uploads/profile_img')) {
                mkdir('uploads/profile_img', 077, true);
            }
            $image->move('uploads/profile_img', $imageName);
        } else {
            $imageName = $mates->photo;
        }
        $email = $mates->email;
        $phone = $mates->phone;
        if ($request->email !== $mates->email) {
            $email = $request->email;
        }
        if ($request->phone !== $mates->phone) {
            $phone = $request->phone;
        }
        $mates->name = $request->name;
        $mates->email = $email;
        $mates->phone = $phone;
        $mates->photo = $imageName;
        $mates->status = $request->status;
        $mates->save();
        return redirect()->route('roommates.index');
    }
}
