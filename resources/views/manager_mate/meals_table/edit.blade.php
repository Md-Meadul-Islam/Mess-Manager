@extends('manager_mate_layouts.app')
@section('manager_title', 'Meal Edit/Update | Mess Manager')
@section('breadcrumb', 'Dashboard / Meal / Edit')
@section('manager_content')
<div class="row">
    <div class="col-lg-12">            
        <div class="card">
            <div class="card-body">
                <div class=" d-flex">
                    <div class="col-lg-6 ">
                        <h1 class="card-title">Edit & Update Meals</h1>
                    </div>
                </div>
                <script>
                    toastr.options = {
                        closeButton: true,
                        positionClass: 'toast-top-right',
                    };                
                    @if(session('toastr'))
                        toastr.{{ session('toastr')['type'] }}('{{ session('toastr')['message'] }}');
                    @endif
                </script>
                <!-- General Form Elements -->
                <form action="{{route('mealstable.update', $column_name)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-lg-3 col-md-2">
                            @php
                                $column_date = explode('_', $column_name)[1];
                                $monthName = $mealTableEdit[0]->month;
                            @endphp
                            <input type="text" name='date' id="date" value="{{$column_name}}" class="form-control" required style="display: none">{{$column_date.'-'.$monthName}}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Edit Meal Details</label>
                        <div class="col-sm-10">
                                <table class="table table-bordered table-striped" name='details'>
                                    <thead>
                                        <tr>
                                            <th class="text-center ">Name</th>
                                            <th class="text-center">BreakFast</th>
                                            <th class="text-center">Lunch</th>
                                            <th class="text-center">Dinner</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($mealTableEdit as $items)
                                        <tr>
                                            <td>
                                                <input name="user_id[]" value="{{$items->user->id}}" style="display: none">{{$items->user->name}}
                                            </td>
                                            @if (!empty($items[$column_name]))
                                                <td><input type="number" name="breakfast[]" value="{{json_decode($items[$column_name])[0]}}" class="form-control"></td>
                                                <td><input type="number" name="lunch[]" class="form-control" value="{{json_decode($items[$column_name])[1]}}"></td>
                                                <td><input type="number" name="dinner[]" class="form-control" value="{{json_decode($items[$column_name])[2]}}"></td>
                                          @else
                                            <td><input type="number" name="breakfast[]" value="0" class="form-control"></td>
                                            <td><input type="number" name="lunch[]" value="0" class="form-control"></td>
                                            <td><input type="number" name="dinner[]" value="0" class="form-control"></td>
                                          @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('mealstable.index')}}" title="Back" class="btn btn-success btn-sm"><i class='fas fa-reply-all'></i></a>
                        <input type="submit" value="Update" class="btn btn-primary btn-sm">
                      </div>
                </form>
                <!-- End General Form Elements -->
            </div>
        </div>
    </div>
</div>
@endsection