@extends('manager_mate_layouts.app')
@section('manager_title', 'Mate Details | Dashboard')
@section('breadcrumb', 'Dashboard / Mates / Index')
@section('manager_content')
<div class="row">
  <div class="col-lg-12">
      <h1 class="text-center">Members</h1>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              @if(session('dates')===now()->format('M-Y'))
              <a class="dropdown-item d-flex align-items-center"data-bs-toggle="modal" data-bs-target="#addnewmate" href="#">
                <span class="btn btn-sm btn-info btn-outline-success">Add New Member</span>
              </a>
              @endif
            </div>
           @if ($mates == [] || count($mates)==0)
           <div class="card-body">
            <p>Please add your Room-Mates/Member.</p>
           </div>
           @else
           <div class="card-body">           
            <div class="row">
              @foreach ($mates as $mate)
                <div class="col-xxl-4 col-md-6 col-lg-4 my-3">
                  <div class="card info-card sales-card align-items-center">
                    <div style="padding:10px; width:100%">
                        <div class="mt-0">
                            <p style="text-align:center"><img src="{{asset('uploads')}}/profile_img/{{$mate->photo}}"
                                alt="Profile" class="rounded-circle " style="width:200px; height:200px;box-shadow:5px 5px 0 rgb(97, 95, 95)"></p>
                        </div>
                        <div>
                          <p><span class="btn btn-outline-success me-2" title="Name"><i class="fa-solid fa-signature"></i></span>{{$mate->name}}</p>
                          <p><span class="btn btn-outline-success me-2" title="Email"><i class="fa-solid fa-envelope"></i></span>{{$mate->email}}</p>
                          <p><span class="btn btn-outline-success me-2" title="Phone"><i class="fa-solid fa-phone"></i></span>{{$mate->phone}}</p>
                          <p>
                            <span class="btn btn-outline-success me-2" title="Active from">
                              <i class="bi bi-person-plus-fill"></i>
                              @php
                                  $date = Carbon\Carbon::createFromFormat('Ymd', $mate->create_at);
                                  $monthYear= $date->format('F Y');
                              @endphp
                            </span>{{$monthYear}}</p>
                          <p><span class="btn btn-outline-success me-2" title="Status"><i class="bi bi-person-fill-gear"></i></span>{{$mate->status}}</p>
                      </div>
                      @if (Auth::user()->role === 'manager')
                        <div class="text-center">
                          <a href="{{route('roommates.edit',$mate->id)}}" title="Edit (status, name etc.)" class="btn btn-secondary btn-outline-info px-5"><i class="fa-solid fa-pen-to-square"></i>
                          </a>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
              </div>
          </div>
           @endif
          </div>
        </div>
      </div>    
  </div>
</div>
@endsection
 <!-- Modal -->
 <div class="modal fade"
    id="addnewmate" data-bs-backdrop="static" data-bs-keyboard="false"    aria-labelledby=""      aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center" id="">Add Member</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('roommates.store')}}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label for="name" class="form-label"><strong>Name</strong><span style="color:red"> *</span></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-signature"></i></span>
                  <input type="text" name="name" class="form-control" required autofocus autocomplete="name">
                </div>
              <div class="col-12">
                <label for="email" class="form-label"><strong>Email</strong></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" autocomplete="email">
                </div>
              </div>
              <div class="col-12">
                <label for="phone" class="form-label"><strong>Phone</strong><span style="color:red; text-align:right"> *</span></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-phone"></i></span>
                  <input type="text" name="phone" class="form-control" required autocomplete="phone">
                </div>
              </div>
              <div class="col-12">
                <label for="photo" class="form-label"><strong>Profile Photo</strong></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-image"></i></span>
                  <input type="file" name="photo" class="form-control">
                </div>
              </div>
              <div class="col-12">
                <label for="password" class="form-label"><strong>New Password</strong><span style="color:red"> *</span></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-unlock"></i></span>
                  <input type="password" name="password" class="form-control" id="password" required autocomplete="new-password">
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
              </div>
              <div class="col-12">
                <label for="password_confirmation" class="form-label"><strong>Confirm Password</strong><span style="color:red"> *</span></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-unlock"></i></span>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required autocomplete="new-password">
                  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
              </div>

              <div class="col-12">
                  <p><span style="color:red">* </span>marked fileds are mandatory.</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class='fas fa-reply-all'></i></button>
              <button type="submit" value="submit" class="btn btn-primary">Create Account</button>
            </div>
        
          </form>
        </div>
       
      </div>
    </div>
  </div>