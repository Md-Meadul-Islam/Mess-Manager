@extends('manager_mate_layouts.app')
@section('title', 'Login || Mess Manager App')
@section('manager_content')
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="{{route('welcome')}}" class="logo d-flex align-items-center w-auto">
                  <img src="{{asset('backend')}}/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Mess Manager</span>
                </a>
              </div><!-- End Logo -->
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Access to your Account!!</h5>
                  </div>
                  <form action="{{route('login')}}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12">
                      <label for="login" class="form-label"><strong>Email / Phone</strong></label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-signature"></i></span>
                        <input type="text" name="login" class="form-control" id="login" required autofocus
                          autocomplete="username" placeholder="Input Email / Phone...">
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="password" class="form-label"><strong>Password</strong></label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-unlock"></i></span>
                        <input type="password" name="password" class="form-control" id="password"
                          placeholder="Input Password" required>
                      </div>
                      @if (Route::has('password.request'))
                      <a class="" href="{{ route('password.request') }}">Forgot Password?
                      </a>
                      @endif
                    </div>


                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Log-In</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0 float-end">Haven't Account? <a href="{{route('register')}}">Create New Account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href="#">Blooms-AI</a>
              </div>

            </div>
          </div>
        </div>

      </section>
    </div>
@endsection