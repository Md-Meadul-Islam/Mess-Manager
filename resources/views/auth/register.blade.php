@extends('manager_mate_layouts.app')
@section('title', 'Login || Mess Manager App')
@section('manager_content')
<style>
  .hidden {
    display: none;
  }
</style>
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
          <a href="{{route('welcome')}}" class="logo d-flex align-items-center w-auto">
            <img src="{{asset('backend')}}/img/logo.png" alt="">
            <span class="d-none d-lg-block">Mess Manager</span>
          </a>
        </div><!-- End Logo -->

        <div class="card mb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Create A New Account</h5>
            </div>

            <form action="{{route('register')}}" method="POST" class="row g-3" enctype="multipart/form-data">
              @csrf

              <div class="col-12">
                <label for="name" class="form-label"><strong>Name</strong><span style="color:red"> *</span></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-signature"></i></span>
                  <input type="text" name="name" class="form-control" id="name" required autofocus autocomplete="name">
                </div>
              </div>
              <div class="col-12">
                <label for="email" class="form-label"><strong>E-mail</strong></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" id="email" autocomplete="email">
                </div>
              </div>

              <div class="col-12">
                <label for="phone" class="form-label"><strong>Phone</strong><span style="color:red; text-align:right">
                    *</span></label>
                <div class="input-group has-validation">
                  <input type="tel" name="phone" class="form-control" id="phone" required autocomplete="phone">
                </div>
              </div>
              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
              <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
              <script>
                function httpGetAsync(url, callback){
                  var xmlHttp = new XMLHttpRequest();
                  xmlHttp.onreadystatechange = function() {
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                      callback(xmlHttp.responseText);
                  }
                  xmlHttp.open("GET", url, true); // true for asynchronous
                  xmlHttp.send(null);
                }
                httpGetAsync('https://ipinfo.io/json', function(response) {
                  var data = JSON.parse(response);
                  
                });
                // $user_ip = getenv('REMOTE_ADDR');
                // $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                const input = document.querySelector("#phone");
                    window.intlTelInput(input, {
                    initialCountry: "bd",
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
                  });
              </script>
              <div class="col-12">
                <label for="photo" class="form-label"><strong>Profile Photo</strong></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-image"></i></span>
                  <input type="file" name="photo" class="form-control" id="photo">
                </div>
              </div>
              <div class="col-12">
                <label for="usertype" class="form-label"><strong>Accout Type</strong></label>
                <div class="input-group">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-user-tie"></i></span>
                  <select name="role" id="role" class="form-select">
                    <option value="manager" selected>Manager</option>
                    <option value="mate">Room-Mate</option>
                  </select>
                </div>
              </div>
              <div id="typeselectoption" class="hidden">
                <div class="col-12">
                  <label for="email2" class="form-label"><strong>Manager's E-mail</strong></label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email2" class="form-control" id="email2" autocomplete="email">
                  </div>
                </div>
                <div class="col-12">
                  <label for="phone2" class="form-label"><strong>Manager's Phone</strong><span
                      style="color:red; text-align:right"> *</span></label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i
                        class="fa-solid fa-phone-volume"></i></span>
                    <input type="text" name="phone2" class="form-control" id="phone2" autocomplete="phone">
                  </div>
                </div>
              </div>
              <script>
                const role = document.querySelector('#role');
                const options = document.querySelector('#typeselectoption');
                document.addEventListener('DOMContentLoaded', function () {
                  role.addEventListener('change', function () {
                    var selectedRole = this.value;
                    if (selectedRole === 'mate') {
                      options.classList.remove('hidden');
                    } else {
                      options.classList.add('hidden');
                    }
                  });
                });
              </script>
              <div class="col-12">
                <label for="password" class="form-label"><strong>New Password</strong><span style="color:red">
                    *</span></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-lock-open"></i></span>
                  <input type="password" name="password" class="form-control" id="password" required
                    autocomplete="new-password">
                </div>
              </div>
              <div class="col-12">
                <label for="password_confirmation" class="form-label"><strong>Confirm Password</strong><span
                    style="color:red"> *</span></label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-unlock"></i></span>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    required autocomplete="new-password">
                </div>
              </div>

              <div class="col-12">
                <p><span style="color:red">* </span>marked fields are mandatory.</p>
              </div>
              <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Create Account</button>
              </div>
              <div class="col-12">
                <p class="small mb-0">Have an Account? <a href="{{route('login')}}">Log-In</a></p>
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
@endsection