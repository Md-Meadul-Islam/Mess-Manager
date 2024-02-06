<?php

namespace App\Http\Controllers;

use App\Models\Tolets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function viewTolet(Request $request)
    {
        $village = $request->village;
        $town = $request->town;
        $city = $request->city;
        $country = $request->country;
        if ($request->all() == []) {
            $user_ip = getenv('REMOTE_ADDR');
            $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
            $country = $geo["geoplugin_countryName"];
            $city = $geo["geoplugin_city"];
        }
        $queryStringArray = [$village, $town, $city];
        $tolets = Tolets::latest();
        foreach ($queryStringArray as $query) {
            $tolets->where(function ($q) use ($query) {
                $q->where('address', 'like', '%' . $query . '%');
            });
        }
        $tolets = $tolets->paginate(12);
        if ($tolets->count() >= 1) {
            $htmlTolets = view('tolets.viewtolet', compact('tolets'))->render();
            return response()->json(['village' => $village, 'city' => $city, 'town' => $town, 'tolets' => $htmlTolets]);
        } else {
            return response()->json(['message' => 'No To-Let Found for these area. Please Search more.']);
        }
    }
    public function makeTolet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'month' => ['required', 'string'],
            'details' => ['required', 'string', 'max:1000'],
            'address' => ['required', 'string', 'max:1000'],
            'contact' => ['required', 'string', 'max:100'],
            'photo1' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'photo2' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);
        $photoFields = ['photo1', 'photo2'];
        $imageNames = [];
        foreach ($photoFields as $field) {
            if ($request->hasFile($field)) {
                $imageName = time() . rand() . '.' . $request->file($field)->getClientOriginalExtension();
                $request->file($field)->storeAs('public/tolet_img', $imageName);
                $imageNames[$field] = $imageName;
            }
        }
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        } else {
            Tolets::create([
                'title' => $request->title,
                'from_month' => $request->month,
                'details' => $request->details,
                'address' => $request->address,
                'contacts' => $request->contact,
                'photo_1' => $imageNames['photo1'] ?? 'toletdefault.png',
                'photo_2' => $imageNames['photo2'] ?? 'toletdefault.png',
                'created_at' => now(),
            ]);
            return response()->json(['message' => 'To-Let Created Sucessful !'], 200);
            // if (Auth::user()) {
            //     if (Auth::user()->role == 'manager') {
            //     } else {
            //         return response()->json(['message' => 'Only Manager can Create a To Let!'], 422);
            //     }
            // } else {
            //     return response()->json(['message' => 'You Should Log In First!'], 421);
            // }
        }
    }
    public function searchKey()
    {
        $searchKey = [];
        $search = Tolets::select('title', 'address')->get()->toArray();
        foreach ($search as $value) {
            $searchKey[] = ucfirst($value['title']);
            $searchKey[] = ucfirst($value['address']);
        }
        return response()->json($searchKey);
    }
    public function searchTolet(Request $request)
    {
        if (preg_match('/^[\p{L}\s]+$/u', $request->searchString)) {
            $tolets = Tolets::where('title', 'like', '%' . $request->searchString . '%')
                ->orwhere('address', 'like', '%' . $request->searchString . '%')
                ->orwhere('details', 'like', '%' . $request->searchString . '%')
                ->latest()->paginate(12);
            if ($tolets->count() >= 1) {
                return view('tolets.viewtolet', compact('tolets'))->render();
            } else {
                return '<span style="color:red;text-align:center;">Nothing Found for- ' . $request->searchString . '! Sorry.</span>';
            }
        } elseif ($request->searchString == null) {
            $tolets = Tolets::latest()->paginate(12);
            return view('tolets.viewtolet', compact('tolets'))->render();
        } else {
            return response()->json(['error' => 'You can search with letters and spaces for all languages.'], 422);
        }
    }
}
