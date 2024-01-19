<?php

namespace App\Http\Controllers\Manager_Mate;

use App\Http\Controllers\Controller;
use App\Models\BazarsTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BazarsTableController extends Controller
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
        $date = strtotime(session('dates'));
        if (Auth::user()->role == 'manager') {
            $bazarlists = BazarsTable::where('batch', $this->batch)->whereMonth('date', (int) date('m', $date))->get();
        } elseif (Auth::user()->role == 'mate') {
            $bazarlists = BazarsTable::where('user_id', Auth::user()->id)->where('batch', $this->batch)->whereMonth('date', (int) date('m', $date))->first();
        }
        return view('manager_mate.bazars_table.index', compact('bazarlists'));
    }
    public function create()
    {
        $users = User::where('batch', $this->batch)->where('status', 'active')->get();
        return view('manager_mate.bazars_table.create', compact('users'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'user_id' => 'required',
            'pname.*' => ['required', 'string', 'max:100', 'regex:/^[\-_]+$/u'],
            'pweight.*' => ['string', 'max:10', 'regex:/^[\-_.]+$/u'],
            'pprice.*' => ['required', 'integer', 'max:5000'],
        ], [
            'pname.*' => 'You can\'t add space and typed more than 100 digits for :attribute!',
            'pweight.*.max' => 'Max digits should be less than :max for :attribute!',
            'pweight.*.regex' => 'Invalid characters for :attribute!',
            'pprice.*.required' => 'The :attribute field is required.',
            'pprice.*.integer' => 'The :attribute must be an integer.',
            'pprice.*.max' => 'Value should be less than or equal to :max for :attribute!',
        ], [
            'pname.*' => 'product_Name',
            'pweight.*' => 'product_Weight',
            'pprice.*' => 'product_Price',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $flattenedErrors = Arr::flatten($errors);
            return back()->with('errors', $flattenedErrors);
        } else {
            $user_id = $request->user_id;
            $pnames = $request->pname;
            $pweights = $request->pweight;
            $pprices = $request->pprice;
            $summation = 0;
            for ($y = 0; $y < count($pprices); $y++) {
                $summation += (int) $pprices[$y];
            }
            $detailsArr = [
                'p_name' => $pnames,
                'p_weight' => $pweights,
                'p_price' => $pprices,
            ];
            if (Auth::user()->role === 'manager') {
                $status = true;
            } else
                $status = false;
            $shopping = new BazarsTable();
            $shopping->user_id = $user_id;
            $shopping->date = $request->date;
            $shopping->details = json_encode($detailsArr);
            $shopping->status = $status;
            $shopping->role = User::find($user_id)->role;
            $shopping->total = $summation;
            $shopping->batch = $this->batch;
            $shopping->created_at = now();
            $shopping->updated_at = null;
            $shopping->save();
        }
        return redirect()->route('bazarstable.index')->with('success', 'Bazars Added Successful !');
    }
    public function edit(string $id)
    {
        $users = User::where('batch', $this->batch)->where('status', 'active')->get();
        $bazarsDetails = BazarsTable::find($id);
        return view('manager_mate.bazars_table.edit', compact('bazarsDetails', 'users'));
    }
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'user_id' => 'required',
            'pname.*' => ['required', 'string', 'max:20', 'regex:/^[\-_]+$/u'],
            'pweight.*' => ['string', 'max:10', 'regex:/^[\-_.]+$/u'],
            'pprice.*' => ['required', 'integer', 'max:5000'],
        ], [
            'pname.*' => 'You can\'t add space and typed more than 100 digits for :attribute!',
            'pweight.*.max' => 'Max digits should be less than :max for :attribute!',
            'pweight.*.regex' => 'Invalid characters for :attribute!',
            'pprice.*.required' => 'The :attribute field is required.',
            'pprice.*.integer' => 'The :attribute must be an integer.',
            'pprice.*.max' => 'Value should be less than or equal to :max for :attribute!',
        ], [
            'pname.*' => 'product_Name',
            'pweight.*' => 'product_Weight',
            'pprice.*' => 'product_Price',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $updateErrors = Arr::flatten($errors);
            return back()->with('errors', $updateErrors);
        } else {
            $user_id = $request->user_id;
            $pnames = $request->pname;
            $pweights = $request->pweight;
            $pprices = $request->pprice;
            $summation = 0;
            for ($y = 0; $y < count($pprices); $y++) {
                $summation += (int) $pprices[$y];
            }
            $detailsArr = [
                'p_name' => $pnames,
                'p_weight' => $pweights,
                'p_price' => $pprices,
            ];
            if (Auth::user()->role == 'manager') {
                $bazars = BazarsTable::find($id);
                $bazars->user_id = $request->user_id;
                $bazars->date = $request->date;
                $bazars->total = $summation;
                $bazars->details = json_encode($detailsArr);
                $bazars->status = true;
                $bazars->role = User::find($user_id)->role;
                $bazars->batch = $this->batch;
                $bazars->updated_at = Carbon::now();
                $bazars->save();
            }
        }
        return redirect()->route('bazarstable.index')->with('success', 'Bazars Updated Successfully !');
    }
    public function bazarstatus(Request $request, $id)
    {
        if (Auth::user()->role === 'manager') {
            $statusFind = BazarsTable::find($id);
            $statusFind->status = true;
            $statusFind->save();
        }
        return redirect()->route('bazarstable.index');
    }
    public function destroy(string $id)
    {
        BazarsTable::find($id)->delete();
        return redirect()->route('bazarstable.index');
    }
}