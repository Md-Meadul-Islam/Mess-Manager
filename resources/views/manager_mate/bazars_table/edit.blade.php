@extends('manager_mate_layouts.app')
@section('manager_title', ' Edit Shopping Details | Mess Manager')
@section('breadcrumb', 'Dashboard / Shopping / Edit')
@section('manager_content')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
           -webkit-appearance: none;
            margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
        <div class="row">
            <div class="col-lg-12">
            
                <div class="card">
                    <div class="card-body">
                        <div class=" d-flex">
                            <div class="col-lg-6 ">
                                <h1 class="card-title"> Edit & Update Bazars</h1>
                            </div>
                        </div>

                        <!-- General Form Elements -->
                        <form action="{{route('bazarstable.update', $bazarsDetails->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row mb-3">
                                <label for="date" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10 col-lg-3 col-md-2">
                                    <input type="date" name='date' id="date" value="{{$bazarsDetails->date}}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="user_id" class="col-sm-2 col-form-label">Marketer Name</label>
                                <div class="col-sm-10">
                                    <select name="user_id" id="user_id" class="form-select" aria-label="Default select example">
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}" <?php if($user->id == $bazarsDetails->user_id) echo "selected";?>>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Product Details</label>
                                <div class="col-sm-10">
                                        <table class="form-control" name='details'>
                                            <thead>
                                                <tr>
                                                    <th class="text-center ">Product Name</th>
                                                    <th class="text-center">Weight<sub>kg/pcs</sub></th>
                                                    <th class="text-center">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $details = json_decode($bazarsDetails->details);
                                                    $array0 = $details->product_name;
                                                    $array1 = $details->product_weight;
                                                    $array2 = $details->product_price;
                                                @endphp
                                                @for ($i = 0; $i < count($array0); $i++)
                                                    <tr class="deleteCell">
                                                        <td><input type="text" name="pname[]" value="{{$array0[$i]}}" class="pname form-control"></td>
                                                        <td><input type="text" name="pweight[]" value="{{$array1[$i]}}" class="pweight form-control" ></td>
                                                        <td><input type="number" name="pprice[]" value="{{$array2[$i]}}" class="pprice form-control"></td>
                                                        <td class="RetrivedDelete" style="text-align: center; font-weight: 800; color: orange; cursor: pointer;">&#10008</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                            <tfoot>
                                                <tr id="add-button-row" style="text-align:center;">
                                                    <td colspan="3" style="padding-top: 5px; color: chocolate; font-size: 20px">
                                                        <a href="#" class="add-button" style="text-decoration: none"><i class="bi bi-plus-circle"></i></a>
                                                    </td>
                                                </tr>
                                            </tfoot>                                            
                                        </table>                                        
                                </div>
                            </div>
                            <div class="card-footer col">
                                <button type="button" id="output-button" class="btn btn-primary" title="Click for Count Total">
                                    Total <span class="badge text-bg-secondary" id="totalValue">{{$bazarsDetails->total}}</span>
                                  </button>
                                <div class="col-lg-6 float-end">
                                    <a href="{{route('bazarstable.index')}}" title="Back" class="btn btn-success btn-sm"><i class='fas fa-reply-all'></i></a>
                                <input type="submit" value="Update" class="btn btn-primary btn-sm btn-outline-info">
                                </div>
                            </div>                        
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
        <script>
          const tbody = document.querySelector('table tbody');
            const addButtonRow = document.querySelector('#add-button-row');
            const templates = `  <tr>
            <td><input type="text" name="pname[]" class="pname form-control" /></td>
            <td><input type="text" name="pweight[]" class="pweight form-control" /></td>
            <td><input type="number" name="pprice[]" class="pprice form-control" /></td>
            <td><a href="#" class="delete">&#10008</a></td>
            </tr>`;
            const addButton = document.querySelector('.add-button');
            const outputButton = document.querySelector('#output-button');

            const addTableRow = () => tbody.innerHTML += templates;
            const removeTableRow = e => e.target.closest('tr').remove();
            const generateTableBody = () => {
                for (let y = 0; y < 1; y++) {
                    addTableRow();
                }
            }
            const generateOutputArray = () => Array.from(tbody.querySelectorAll('tr')).map(tr => ({
                pprice: tr.querySelector('.pprice').value
            }));

            addButton.addEventListener('click', addTableRow);
            tbody.addEventListener('click', e => {
                e.preventDefault();
                if(e.target.classList.contains('RetrivedDelete')){
                    removeTableRow(e);
                }
                if (e.target.classList.contains('delete'))
                    removeTableRow(e);
            })
            generateTableBody();
            total = 0;
            outputButton.addEventListener('click', (e) => {
                e.preventDefault();
                // var summation = generateOutputArray();
                generateOutputArray().forEach((sum) => {
                    total += Number(sum.pprice);
                })
                document.querySelector('#totalValue').innerHTML = total;
            });
        </script>
@endsection

