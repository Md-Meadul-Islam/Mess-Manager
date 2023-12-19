@extends('manager_mate_layouts.app')
@section('manager_title', 'Meal Details | Mess Manager')
@section('breadcrumb', 'Dashboard / Meal / Index')
@section('manager_content')
@if (session('toastr'))
<script>
    toastr.options = {
        closeButton: true,
        positionClass: 'toast-top-right',
    };  
    toastr.{{ session('toastr')['type'] }}('{{ session('toastr')['message'] }}'); 
</script>    
@endif
<div class="row">
    <div class="col-lg-12">
        <h1>Meals Table</h1>
        <div class="card">
            <div class="card-header">
                <p>You can view @if (Auth::user()->role === 'mate')your
                @else your's and each Room-mate's 
                @endif
                <span style="color: red; font-weight:800">Breakfast(B)</span>,<span style="color: red; font-weight:800"> Lunch(L)</span>, <span style="color: red; font-weight:800"> Dinner(D)</span> data in this Table, and You don't need to create it again, just <strong>Edit & Update</strong> the specific date's data.</p>
            </div>
            <div class="card-body">
                @if (!empty($mealsByUser))
                <table class="table table-bordered table-striped" id="mealdetails">
                    <thead>
                        <tr>
                            <th style="text-align:center; background-color:rgb(78, 105, 95)">Day/Date</th>
                            @foreach ($mealsByUser as $users)
                            <th colspan="3" style="text-align:center; background-color:rgb(78, 105, 95)" class="u ">{{$users->user->name}}</th>                           
                            @endforeach
                            <th style="text-align:center; background-color:rgb(78, 105, 95)">Edit & Update</th>
                        </tr>
                        <tr>
                            <th></th>
                            @foreach ($mealsByUser as $users)
                            <th title="BreakFast" style="text-align: center; background-color: rgb(107, 107, 134)">B</th>
                            <th title="Lunch" style="text-align: center; background-color:rgb(125, 151, 141)">L</th>
                            <th title="Dinner" style="text-align: center; background-color:rgb(133, 117, 148)">D</th>
                            @endforeach
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            if (session('dates')!== now()->format('M-Y')) {
                                $date = strtotime(session('dates'));
                                $days_in_month = cal_days_in_month(CAL_GREGORIAN, (int) date('m', $date), (int)date('y', $date));
                            }else{
                                $days_in_month = (int)date('d');
                            }
                        @endphp
                        @for ($day = 1; $day <= $days_in_month; $day++)
                        <tr>
                            <td style="text-align:center;">{{$day.'-'.$mealsByUser[0]->month}}</td>
                            @foreach ($mealsByUser as $userId => $meals)
                            @if (!empty($meals) && isset($meals->{"day_$day"}))
                            <td class="b text-center table-primary">{{json_decode($meals->{"day_$day"})[0]}}</td>                                
                            <td class="l text-center table-info">{{json_decode($meals->{"day_$day"})[1]}}</td>                                
                            <td class="d text-center table-secondary">{{json_decode($meals->{"day_$day"})[2]}}</td>
                            @else
                            <td class="b text-center table-primary">0</td>                                
                            <td class="l text-center table-info">0</td>                                
                            <td class="d text-center table-secondary">0</td>                                
                            @endif                            
                            @endforeach
                            <td style="text-align:center;">
                                @if (Auth::user()->role ==='manager' && session('dates')===now()->format('M-Y') && $day > (int)date('d') - 7)
                                <a href="{{route('mealstable.edit', $day)}}" title="Edit" class="btn btn-danger btn-sm">
                                    <i class='fas fa-pen-nib'></i></a>
                                @else
                                <a href="#" title="Cannot Edit" class="btn btn-info btn-sm"><i class='fas fa-remove-format'></i></a>
                                @endif
                            </td>
                        </tr>                           
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: center; background-color:rgb(78, 105, 95)">Total Meals</th>
                            @foreach ($mealsByUser as $key=>$users)
                            <th colspan="3" style="text-align: center; background-color:rgb(78, 105, 95)" class="r"></th>                                
                            @endforeach
                            <th style="text-align: center; background-color:rgb(78, 105, 95)" class="inTotal"></th>
                        </tr>
                    </tfoot>
                </table>                    
                @else
                    <table>
                        <th>No Data Found!</th>
                    </table>
                @endif
            </div>
            {{-- card-body --}}
            <script>
                const tbody = document.querySelector('table tbody');
                const ulength = document.querySelectorAll('.u');
                const EArr = ()=>[...tbody.querySelectorAll('tr')].map(tr=>({
                    b:[...tr.querySelectorAll('.b')].map(b=>b.innerText),
                    l:[...tr.querySelectorAll('.l')].map(l=>l.innerText),
                    d:[...tr.querySelectorAll('.d')].map(d=>d.innerText)
                }));
                var user = [];
                var us =0;
                for (let m = 0; m < ulength.length; m++) {
                    for (let r = 0; r < EArr().length; r++) {
                        var b = EArr()[r]['b'][m];                        
                        var l = EArr()[r]['l'][m];                        
                        var d = EArr()[r]['d'][m];   
                        user.push(parseInt(b)+parseInt(l)+parseInt(d));                     
                    }                    
                }
                const result = [];
                for (let i = 0; i < user.length; i+=EArr().length) {
                    const sum = user.slice(i, i+EArr().length).reduce((acc, val)=>acc+val, 0);
                    result.push(sum);                    
                }
                const r = document.querySelectorAll('.r');
                for (let k = 0; k < r.length; k++) {
                    r[k].innerText = result[k];                    
                }
                const inTotal = result.reduce((accu, value)=>accu+value, 0);
                document.querySelector('.inTotal').innerText = 'In-Total: '+ inTotal;
            </script>
        </div>
    </div>
</div>
@endsection