<?php

namespace App\Http\Controllers\Manager_Mate;

use App\Http\Controllers\Controller;
use App\Models\Tolets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ToletsController extends Controller
{
    public function dashboardTolet()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $tolets = Tolets::where('user_id', Auth::user()->id)
            ->orWhere('ip', $ip)->get();
        return view('manager_mate.tolets.index', compact('tolets'))->render();
    }
    public function editTolet(Request $request)
    {
        $tolets = Tolets::find($request->id);
        return view('manager_mate.tolets.edit', compact('tolets'))->render();
    }
    public function updateTolet(Request $request)
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
        $exPhoto1 = null;
        $exPhoto2 = null;
        $query = Tolets::find($request->id);
        foreach ($photoFields as $field) {
            if ($request->hasFile($field)) {
                $imageName = time() . rand() . '.' . $request->file($field)->getClientOriginalExtension();
                $request->file($field)->storeAs('public/tolet_img', $imageName);
                $imageNames[$field] = $imageName;
            } else {
                $exPhoto1 = $query->photo_1;
                $exPhoto2 = $query->photo_2;
            }
        }
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        } else {
            if (Auth::user()->role == 'manager') {
                $query->update([
                    'user_id' => Auth::user()->id,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'title' => $request->title,
                    'from_month' => $request->month,
                    'details' => $request->details,
                    'address' => $request->address,
                    'contacts' => $request->contact,
                    'photo_1' => $imageNames['photo1'] ?? $exPhoto1,
                    'photo_2' => $imageNames['photo2'] ?? $exPhoto2,
                    'updated_at' => now(),
                ]);
                return response()->json(['message' => 'To-Let Updated Sucessfully !'], 200);
            } else {
                return response()->json(['message' => 'Only Manager can Update a To-Let !'], 422);
            }
        }
    }
    public function deleteTolet(Request $request)
    {
        Tolets::find($request->id)->delete();
        return response()->json(['Success' => 'To Let Successfully Deleted']);
    }
}
