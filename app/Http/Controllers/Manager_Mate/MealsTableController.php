<?php

namespace App\Http\Controllers\Manager_Mate;

use App\Http\Controllers\Controller;
use App\Models\MealsTable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealsTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $sessionDate = Carbon::createFromFormat('M-Y', session('dates'));
        if (session('dates') === now()->format('M-Y')) {
            $users = User::where('batch', $this->batch)->where('status', 'active')->get();
        } elseif (session('dates') > now()->format('M-Y')) {
            $mate = User::where('batch', $this->batch);
            $users = $mate->where(function ($query) use ($sessionDate) {
                $query->whereMonth('created_at', '<', $sessionDate->month)
                    ->orWhere(function ($query) use ($sessionDate) {
                        $query->whereMonth('created_at', $sessionDate->month)
                            ->whereYear('created_at', $sessionDate->year);
                    });
            })->get();
        } else
            $users = null;
        $mealsByUser = [];
        if (Auth::user()->role === 'mate') {
            $meals = MealsTable::where('user_id', Auth::user()->id)->where('month', session('dates'))->with('user')->first();
            $mealsByUser[] = $meals;
        } else {
            foreach ($users as $user) {
                $userId = $user->id;
                $meals = MealsTable::where('user_id', $userId)->where('month', session('dates'))->with('user')->first();
                $mealsByUser[] = $meals;
            }
        }
        return view('manager_mate.meals_table.index', compact('mealsByUser'));
    }
    public function edit(string $column)
    {
        $column_name = 'day_' . $column;
        $users = User::where('batch', $this->batch)->where('status', 'active')->get();

        if ($column > (int) date('d') - 7) {
            $mealTableEdit = MealsTable::select([$column_name, 'user_id', 'month'])->where('batch', $this->batch)->where('month', session('dates'))->with('user')->get();
            session()->flash('toastr', ['type' => 'success', 'message' => 'Edit $ Updated Successful!']);
        } else {
            session()->flash('toastr', ['type' => 'error', 'message' => 'Update Failed. Please try again!']);
        }
        return view('manager_mate.meals_table.edit', compact('mealTableEdit', 'column_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $column_name)
    {
        for ($i = 0; $i < count($request->user_id); $i++) {
            $meals = [];
            array_push($meals, [$request->breakfast[$i], $request->lunch[$i], $request->dinner[$i]]);
            MealsTable::updateOrInsert([
                'user_id' => $request->user_id[$i],
                'month' => session('dates'),
                'batch' => $this->batch,
            ], [
                $column_name => $meals[0],
                'updated_at' => now(),
            ]);
        }
        session()->flash('toastr', ['type' => 'success', 'message' => 'Edit $ Updated Successful!']);
        return redirect()->route('mealstable.index');
    }
}
