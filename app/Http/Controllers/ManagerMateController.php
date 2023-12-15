<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerMateController extends Controller
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
    protected $selectedMonth;
    public function monthSelect(Request $request)
    {
        if ($request->has('monthSelect')) {
            $this->selectedMonth = $request->input('monthSelect');
        } else {
            $this->selectedMonth = now()->format('M-Y');
        }
        session()->put('dates', $this->selectedMonth);
        return redirect()->back();
    }
    public function Index()
    {
        session()->put('dates', now()->format('M-Y'));



        return view('manager_mate.dashboard');
    }
}
