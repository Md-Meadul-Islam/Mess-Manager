@extends('manager_mate_layouts.app')
@section('manager_title', 'Bazar Details | Mess Manager')
@section('breadcrumb', 'Dashboard / Bazar / Index')
@section('manager_content')
<style>
    .accordion {
      text-align: center;
      font-size: 15px;
      transition: 0.4s;
  }
  .accordion i {
      color: saddlebrown;
      transition: .5s;
  }
  .accordion.active {
      cursor: pointer;
  }
  .accordion.active i {
      color: seagreen;
      transition: all .5s;
      text-align: center;
  }
  .accordion:hover {
      background-color: #ccc;
  }
  .accordion_content {
      padding: 0 18px;
      background-color: white;
      display: none;
      overflow: hidden;
  } 
  .table-container{
    overflow: auto;
    scrollbar-color: rgb(78, 105, 95) transparent;
  }
  #bazartable thead tr th, #bazartable tfoot tr th{
    background-color:rgb(78, 105, 95);
  }
  #bazartable{
    border-collapse: collapse;
  }
    /* Webkit (Chrome, Safari, newer versions of Opera) */
    .table-container::-webkit-scrollbar {
      width: 5px;
      height: 5px;
    }
    .table-container::-webkit-scrollbar-thumb {
      background-color: rgb(78, 105, 95);
      border-radius: 5px;
    }
    /* Firefox */
    .table-container::-moz-scrollbar {
      width: 5px;
      height: 5px;
    }
    .table-container::-moz-scrollbar-thumb {
      background-color: rgb(78, 105, 95);
      border-radius: 5px;
    }
    /* Microsoft Edge and IE */
    .table-container::-ms-scrollbar {
      width: 5px;
      height: 5px;
    }
    .table-container::-ms-scrollbar-thumb {
      background-color: rgb(78, 105, 95);
      border-radius: 5px;
    }
    .table-container::-ms-scrollbar-track {
      background-color: transparent;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h2>Bazars Details</h2>
        <div class="card">
            <div class="card-header">
                @if (session('dates') === now()->format('M-Y'))
                <h3 class="card-title"><a href="{{route('bazarstable.create')}}" class="btn btn-info btn-outline-success">Add New Bazar</a></h3>
                @endif 
                <p><span style="color: red; font-weight:800">{{__('N.B. ')}}</span>{{__('You can update Bazar details for the last seven days of a month multiple times.')}}</p>               
            </div>
            <div class="card-body table-container">
                <table id="bazartable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Date</th>
                            <th>Marketer Name</th>
                            <th>Total</th>
                            <th>Details</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($bazarlists) !== 0)
                            @foreach ($bazarlists as $key =>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->total}}/=</td>
                                <td id="accordion" class="accordion"><i class="fa-solid fa-angle-down"></i></td>
                                <td>
                                    @php
                                        $timestamp = strtotime($item->date);
                                        $day = date('d', $timestamp);
                                    @endphp     
                                    @if (Auth::user()->role=='manager' && (int)$day > (int)date('d')-7)
                                    <a href="{{route('bazarstable.edit', $item->id)}}" title="Edit" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{route('bazarstable.destroy', $item->id)}}" method="post" id="delete-form-{{$item->id}}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        <button title="Delete" class="btn btn-info btn-sm btn-outline-danger" onclick="
                                      if(confirm('Are you sure to Delete this?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{$item->id}}').submit();
                                        } "><i class="fa-solid fa-trash"></i></button>
                                    @endif                                    
                                </td>
                                <td>
                                    @if(Auth::user()->role === 'manager' && $item->status===0)
                                    <form action="{{route('bazarstatus',$item->id)}}" method="post" id="status-form-{{$item->id}}" style="display:none;">
                                        @csrf
                                      </form>
                                      <button title="Status" class="btn btn-warning btn-sm" onclick="
                                  if(confirm('Are you sure to add This Bazars?')){
                                    event.preventDefault();
                                    document.getElementById('status-form-{{$item->id}}').submit();
                                    }else{
                                        event.preventDefault();}">
                                        Pending</button>
                                    @elseif (Auth::user()->role === 'mate' && $item->status === 0)
                                    <a href="#" class="btn btn-sm btn-warning">Pending</a>
                                    @else
                                    <a href="#" class="btn btn-sm btn-success">Approved</a>
                                    @endif
                                </td>
                                @php
                                    $creationDate = Carbon\Carbon::parse($item->created_at);
                                    $create_at = $creationDate->diffForHumans();
                                    $update_at = null;
                                    if($item->updated_at){
                                        $updateDate = Carbon\Carbon::parse($item->updated_at);
                                        $update_at = $updateDate->diffForHumans();
                                    }                                    
                                @endphp
                                <td>{{$create_at}}</td>
                                <td>{{$update_at}}</td>                                
                            </tr>
                            <tr class="accordion_row">
                                <td colspan="9" class="accordion_content">
                                    <div class="">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Weight<sub>kg/pcs</sub></th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $details=json_decode($item->details);
                                            @endphp
                                                @for ($i = 0; $i < count($details->p_name); $i++)
                                                    <tr>
                                                        <td style="font-family:cursive;">{{ $details->p_name[$i] }}</td>
                                                        <td style="font-family:cursive;">{{ $details->p_weight[$i] }}</td>
                                                        <td style="font-family:cursive;">{{ $details->p_price[$i] }}</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                              </tr>                                
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td colspan="7" style="color: red; font-family:cursive; text-align:center;"><h4>No Record found! @if (session('dates')===now()->format('M-Y'))
                                    <span style="color: green;">Please click <a href="{{route('bazarstable.create')}}" class="btn btn-info btn-outline-success">Add New Bazar</a> for adding new bazars.</span>                                    
                                @endif</h4></td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>SL.</th>
                            <th>Date</th>
                            <th>Marketer Name</th>
                            <th>Total</th>
                            <th>Details</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var acc = document.getElementsByClassName("accordion");
      var i;
      for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function () {
              this.classList.toggle("active");
              this.childNodes[0].classList.toggle("fa-rotate-180");
              var panel = this.parentElement.nextElementSibling.firstElementChild;
                      if (panel.style.display === "table-cell") {
                          panel.style.display = "none";
                      } else {
                          panel.style.display = "table-cell";
                      }
          });
      }
  </script>
@endsection