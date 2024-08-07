<?php

namespace App\Http\Controllers\Manager_Mate;

use App\Http\Controllers\Controller;
use App\Models\MealsTable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $mealsByUser = [];
        if (Auth::user()->role === 'mate') {
            $meals = MealsTable::where('user_id', Auth::user()->id)->where('month', session('dates'))->with('user')->first();
            if ($meals == null) {
                $mealsByUser = [];
            } else
                $mealsByUser[] = $meals;
        } else {
            foreach ($users as $user) {
                $userId = $user->id;
                $meals = MealsTable::where('user_id', $userId)->where('month', session('dates'))->with('user')->first();
                $mealsByUser[] = $meals;
            }
        }
        //for one time update
        $userCreatedAt = Carbon::createFromFormat('Ymd', Auth::user()->create_at);
        $userCreationMonth = 1;
        if ($userCreatedAt->format('m') == Carbon::now()->format('m')) {
            $userCreationMonth = 0;
        } else
            $userCreationMonth = 1;
        return view('manager_mate.meals_table.index', compact('mealsByUser', 'userCreationMonth'));
    }
    public function edit(string $column)
    {
        $column_name = 'day_' . $column;
        $users = User::where('batch', $this->batch)->where('status', 'active')->get();
        $mealTableArray = MealsTable::select([$column_name, 'user_id', 'month'])->where('batch', $this->batch)->where('month', session('dates'))->with('user')->get();
        if (Auth::user()->role == 'manager' && $mealTableArray[0]->$column_name == null) {
            $mealTableEdit = $mealTableArray;
        } elseif (Auth::user()->role == 'manager' && $column > (int) date('d') - 7) {
            $mealTableEdit = $mealTableArray;
        }

        return view('manager_mate.meals_table.edit', compact('mealTableEdit', 'column_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $column_name)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'breakfast.*' => ['required', 'integer', 'max:10'],
            'lunch.*' => ['required', 'integer', 'max:10'],
            'dinner.*' => ['required', 'integer', 'max:10'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $updateErrors = Arr::flatten($errors);
            return back()->with('errors', $updateErrors);
        } else {
            for ($i = 0; $i < count($request->user_id); $i++) {
                $meals = [];
                array_push($meals, [$request->breakfast[$i], $request->lunch[$i], $request->dinner[$i]]);
                MealsTable::updateOrInsert([
                    'user_id' => $request->user_id[$i],
                    'month' => session('dates'),
                    'batch' => $this->batch,
                ], [

                    $column_name => $meals[0],
                    'update_at' => now()->format('Ymd'),
                    'updated_at' => now(),
                ]);
            }
            return redirect()->route('mealstable.index')->with('success', 'Meals Updated Successfully !');
        }
    }
}
