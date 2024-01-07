<?php

namespace App\Http\Controllers;

use App\Models\BazarsTable;
use App\Models\MealsTable;
use App\Models\MonthlyTable;
use App\Models\User;
use Carbon\Carbon;
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
        $sessionDate = Carbon::createFromFormat('M-Y', session('dates'));
        $currentDate = now();
        $currentDateNumeric = intval($currentDate->format('Ymd'));
        $sessionDateNumeric = intval($sessionDate->format('Ymd'));
        $sessionDateStartOfMonth = intval($sessionDate->startOfMonth()->format('Ymd'));
        $sessionDateEndOfMonth = intval($sessionDate->endOfMonth()->format('Ymd'));
        $sessionDateAddOneMonth = intval($sessionDate->startOfMonth()->addMonth()->format('Ymd'));
        $users = [];
        $users = User::when($sessionDateNumeric == $currentDateNumeric, function ($query) {
            $query->where('status', 'active')->where('batch', $this->batch);
        })
            ->when($sessionDateNumeric < $currentDateNumeric, function ($query) use ($sessionDateStartOfMonth, $sessionDateEndOfMonth, $sessionDateAddOneMonth) {
                $query->where(function ($query) use ($sessionDateAddOneMonth) {
                    $query->where('status', 'active')->where('batch', $this->batch)
                        ->where('create_at', '<=', $sessionDateAddOneMonth);
                })
                    ->orWhere(function ($query) use ($sessionDateStartOfMonth, $sessionDateEndOfMonth) {
                        $query->where('status', 'inactive')->where('batch', $this->batch)
                            ->where('update_at', '>=', $sessionDateStartOfMonth)
                            ->where('update_at', '<=', $sessionDateEndOfMonth);
                    });
            })
            ->get();
        // for insert into database  total meal by user
        if ($users) {
            foreach ($users as $user) {
                $userId = $user->id;
                $mealByUser = MealsTable::where('user_id', $userId)->where('month', session('dates'))->first();
                $totalCountasUser = 0;
                if ($mealByUser) {
                    for ($i = 1; $i <= 31; $i++) {
                        if (!$mealByUser->{"day_$i"}) {
                            $mealByUser->{"day_$i"} = 0;
                        } else {
                            $mealcount = 0;
                            for ($y = 0; $y < 3; $y++) {
                                $mealcount += (int) (json_decode($mealByUser->{"day_$i"})[$y]);
                            }
                            $mealByUser->{"day_$i"} = $mealcount;
                        }
                        $totalCountasUser += (int) $mealByUser->{"day_$i"};
                    }
                }
                MealsTable::updateOrInsert([
                    'user_id' => $userId,
                    'month' => session('dates'),
                    'batch' => $this->batch,
                ], [

                    'total' => $totalCountasUser,
                    'update_at' => now()->format('Ymd'),
                    'updated_at' => now(),
                ]);
            }
        }
        // for database table insert MonthlyTable
        $bazarsArr = [];
        $allMeals = [];
        if (Auth::user()->role == 'manager' || Auth::user()->role == 'mate') {
            $sessionDate = Carbon::createFromFormat('M-Y', session('dates'));
            $bazarsArr = BazarsTable::where('batch', $this->batch)->whereMonth('date', (int) $sessionDate->month)->with('user')->groupBy('user_id')->select('user_id', \DB::raw('SUM(total) as total'))->get();
            $totalbazar = 0;
            foreach ($bazarsArr as $value) {
                $totalbazar += $value->total;
            }
            $allMeals = MealsTable::where('batch', $this->batch)->where('month', session('dates'))->pluck('total', 'user_id')->toArray();
            $totalMeals = 0;
            foreach ($allMeals as $value) {
                $totalMeals += $value;
            }

            $allbazar = BazarsTable::where('batch', $this->batch)->whereMonth('date', (int) $sessionDate->month)->groupBy('user_id')->select('user_id', \DB::raw('SUM(total) as total'))->get();
            MonthlyTable::updateOrInsert(
                [
                    'batch' => $this->batch,
                    'month' => session('dates'),
                ],
                [
                    'dailymeals' => json_encode($allMeals),
                    'totalmeals' => $totalMeals,
                    'dailybazar' => json_encode($allbazar),
                    'totalbazar' => $totalbazar,
                    'batch' => $this->batch
                ],
            );
        }
        $monthlyDetails = MonthlyTable::where('batch', $this->batch)->where("month", session('dates'))->first();

        return view('manager_mate.dashboard', compact('users', 'bazarsArr', 'allMeals', 'monthlyDetails'));
    }
    public function otherExpences(Request $request, $id)
    {
        if (Auth::user()->role == 'manager') {
            $Ename = $request->ename;
            $Eprice = $request->eprice;
            $summation = 0;
            for ($y = 0; $y < count($Eprice); $y++) {
                $summation += (int) $Eprice[$y];
            }
            $detailsArray = [
                'ename' => $Ename,
                'eprice' => $Eprice
            ];
            $monthly_expences = MonthlyTable::find($id);
            $grandTotal = $monthly_expences->totalbazar + $monthly_expences->expence_total;
            $mealRate = $grandTotal / $monthly_expences->totalmeals;
            $monthly_expences->other_expence = json_encode($detailsArray);
            $monthly_expences->expence_total = $summation;
            $monthly_expences->meal_rate = $mealRate;
            $monthly_expences->save();
        }
        return redirect()->route('manager_mate.dashboard');
    }
    public function faq()
    {
        return view('manager_mate.faq');
    }
}
