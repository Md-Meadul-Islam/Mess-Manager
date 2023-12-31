<?php

namespace App\Http\Controllers\Manager_Mate;

use App\Http\Controllers\Controller;
use App\Models\BazarsTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $bazarlists = BazarsTable::where('batch', $this->batch)->whereMonth('date', (int) date('m', $date))->get();
        return view('manager_mate.bazars_table.index', compact('bazarlists'));
    }
    public function create()
    {
        $users = User::where('batch', $this->batch)->where('status', 'active')->get();
        return view('manager_mate.bazars_table.create', compact('users'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'user_id' => 'required'
        ]);

        $summation = 0;
        $pnameArr = [];
        $pweightArr = [];
        $ppriceArr = [];

        $lengthInput = (count($request->all()) - 3) / 3;
        for ($i = 0; $i < $lengthInput; $i++) {

            $pname = 'pname' . $i;
            $pwieght = 'pweight' . $i;
            $pprice = 'pprice' . $i;

            $pnameArr[] = $request->$pname;
            $pweightArr[] = $request->$pwieght;
            $ppriceArr[] = $request->$pprice;
        }
        for ($y = 0; $y < count($ppriceArr); $y++) {
            $summation += (int) $ppriceArr[$y];
        }
        $detailsArr = [
            'p_name' => $pnameArr,
            'p_weight' => $pweightArr,
            'p_price' => $ppriceArr
        ];

        $shopping = new BazarsTable();
        $shopping->user_id = $request->user_id;
        $shopping->date = $request->date;
        $shopping->details = json_encode($detailsArr);
        $shopping->total = $summation;
        $shopping->batch = $this->batch;
        $shopping->save();

        return redirect()->route('bazarstable.index');
    }
    public function edit(string $id)
    {
        $users = User::where('batch', $this->batch)->where('status', 'active')->get();
        $bazarsDetails = BazarsTable::find($id);
        return view('manager_mate.bazars_table.edit', compact('bazarsDetails', 'users'));
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'date' => 'required',
            'user_id' => 'required',
            'pname' => 'required',
            'pweight' => 'required',
            'pprice' => 'required',
        ]);
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
        $bazars = BazarsTable::find($id);
        $bazars->user_id = $request->user_id;
        $bazars->date = $request->date;
        $bazars->total = $summation;
        $bazars->details = json_encode($detailsArr);
        $bazars->role = User::find($user_id)->role;
        $bazars->batch = $this->batch;
        $bazars->updated_at = Carbon::now();
        $bazars->save();

        return redirect()->route('bazarstable.index');
    }
    public function destroy(string $id)
    {
        BazarsTable::find($id)->delete();
        return redirect()->route('shopping_detials.index');
    }
}
