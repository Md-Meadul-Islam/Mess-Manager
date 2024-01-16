@extends('manager_mate_layouts.app')
@section('manager_title', ' Add Bazar | Dashboard')
@section('breadcrumb', 'Dashboard / Bazar / Create')
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
                                <h1 class="card-title"> Add New Bazar</h1>
                            </div>
                        </div>
                        <!-- General Form Elements -->
                        <form action="{{route('bazarstable.store')}}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="date" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10 col-lg-3 col-md-2">
                                    <input type="date" name='date' id="date" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="user_id" class="col-sm-2 col-form-label">Marketer Name</label>
                                <div class="col-sm-10">
                                    <select name="user_id" id="user_id" class="form-select" aria-label="Default select example">
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
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
                                                    <th class="text-center ">Name</th>
                                                    <th class="text-center">Weight<sub>/kg</sub></th>
                                                    <th class="text-center">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
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
                                    Total <span class="badge text-bg-secondary" id="totalValue">000</span>
                                  </button>
                                <div class="col-lg-6 float-end">
                                    <a href="{{route('bazarstable.index')}}" title="Back" class="btn btn-success btn-sm"><i class='fas fa-reply-all'></i></a>
                                @if (Auth::user()->role == 'manager')
                                <input type="submit" value="Create" class="btn btn-primary btn-sm">
                                @else
                                <input type="submit" value="Send Request" class="btn btn-primary btn-sm">
                                @endif
                                </div>
                            </div>                            
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
        <script>
            let tbody = document.querySelector('tbody');
            let addBtn = document.querySelector('#add-button-row');
            let outputButton = document.querySelector('#output-button');
            let i = 4;
            function creatTableEl() {
                const createTR = document.createElement("tr");
                tbody.appendChild(createTR);
                const createTD1 = document.createElement("td");
                const createTD2 = document.createElement("td");
                const createTD3 = document.createElement("td");
                const createTD4 = document.createElement("td");
                createTR.append(createTD1, createTD2, createTD3, createTD4);
                //for td 1 for Product Name
                const createInputField1 = document.createElement("input");
                createTD1.appendChild(createInputField1);
                createInputField1.setAttribute("type", "text");
                createInputField1.setAttribute("name", 'pname[]');
                createInputField1.setAttribute('class', 'pname form-control');
                //for td 2 for Product Weight
                const createInputField2 = document.createElement("input");
                createTD2.appendChild(createInputField2);
                createInputField2.setAttribute("type", "text");
                createInputField2.setAttribute("name", 'pweight[]');
                createInputField2.setAttribute('class', 'pweight form-control');
                //for td 3 or Product Price
                const createInputField3 = document.createElement("input");
                createTD3.appendChild(createInputField3);
                createInputField3.setAttribute("type", "number");
                createInputField3.setAttribute("name", 'pprice[]');
                createInputField3.setAttribute("class", "pprice form-control");
                //for Delete Button or td six.
                createTD4.style.textAlign = "center";
                createTD4.style.fontWeight = "900";
                createTD4.setAttribute("id", "Delete");
                createTD4.innerHTML = "&#10008";
                createTD4.style.color = "red";
                createTD4.style.cursor = "pointer";
                createTD4.addEventListener("mouseover", changeStyleOver);
                function changeStyleOver() {
                    createTD4.style.color = "red";
                }
                createTD4.addEventListener("mouseout", changeStyleOut);
                function changeStyleOut() {
                    createTD4.style.color = "orange";
                }
                //for Delete Button
                createTD4.addEventListener("click", DeleteCells);
                function DeleteCells() {
                    const deleteCellIDs = createTR.getAttribute("id");
                    // console.log(deleteCellIDs);
                    createTR.remove(deleteCellIDs);
                }
                return createTR;
            }
            function addTableRowBtn() {
                const tableEle = creatTableEl();
                tbody.append(tableEle);
            }
            function Table() {
                for (let y = 0; y < 4; y++) {
                    const constTableEle = creatTableEl();
                    tbody.append(constTableEle);
                }
                addBtn.addEventListener("click", addTableRowBtn);
            }
            Table();
            const generateOutputArray = () => Array.from(tbody.querySelectorAll('tr')).map(tr => ({
                pprice: tr.querySelector('.pprice').value
            }));
            total = 0;
            outputButton.addEventListener('click', (e) => {
                e.preventDefault();
                generateOutputArray().forEach((sum) => {
                    total += Number(sum.pprice);
                })
                document.querySelector('#totalValue').innerHTML = total;
            });
        </script>
@endsection

