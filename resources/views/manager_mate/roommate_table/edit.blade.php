@extends('manager_mate_layouts.app')
@section('manager_title', 'Mate Details | Dashboard')
@section('breadcrumb', 'Dashboard / Mate / Edit')
@section('manager_content')
<div class="row">
  <div class="col-lg-12">
      <h1 class="text-center">Room-Mates</h1>
      <div class="row">
        <div class="col-12">
          <div class="card">
           <div class="card-body">
                <form action="{{route('roommates.update', $mates->id)}}" method="POST" class="row g-3" enctype="multipart/form-data">
                  @csrf
                  @method('PATCH')
                  <div class="col-12">
                    <div>
                      <p style="text-align:center"><img src="{{asset('uploads')}}/profile_img/{{$mates->photo}}"
                          alt="Profile" class="rounded-circle" style="width:200px; height:200px"></p>
                    </div>
                    <label for="name" class="form-label"><strong>Name</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-signature"></i></span>
                      <input type="text" name="name" class="form-control" id="name" required autofocus autocomplete="name"
                        value="{{$mates->name}}">
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-envelope"></i></span>
                      <input type="email" name="email" class="form-control" id="email" autocomplete="email"
                        value="{{$mates->email}}">
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="phone" class="form-label"><strong>Phone</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-phone"></i></span>
                      <input type="text" name="phone" class="form-control" id="phone" required autocomplete="phone"
                        value="{{$mates->phone}}">
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="photo" class="form-label"><strong>Profile Photo</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-image"></i></span>        
                      <input type="file" name="photo" class="form-control" id="photo">
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="status" class="form-label"><strong>Status</strong></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-people-arrows"></i></span>
                      <select name="status" id="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                  </div>
                  <div class="card-footer">
                    <a href="{{route('roommates.index')}}" class="btn btn-success"><i class='fas fa-reply-all'></i></a>
                    <input type="submit" value="Save Changes" class="btn btn-primary">
                  </div>
                </form>
          </div>
          </div>
        </div>
      </div>    
  </div>
</div>
@endsection