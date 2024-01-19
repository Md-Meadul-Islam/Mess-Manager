<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="{{route('manager_mate.dashboard')}}" class="logo d-flex align-items-center">
      <img src="{{asset('backend')}}/img/logo.png" alt="">
      <span class="d-none d-lg-block">Mess Manager</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->
  <nav class="header-nav ms-auto d-flex">
    <ul class="d-flex align-items-center">
      <li class="nav-item pe-3"><a class="nav-link" href="{{route('welcome')}}" title="Welcome page">Home</a></li>
    </ul>
    <ul class="d-flex align-items-center mediaHide" id="mediaHide">
      <li class="nav-item pe-3 monthSelect">
        <form action="{{route('monthselect')}}" method="GET" id="monthForm">
          @csrf
          <div class="d-flex px-0"
            style="border: 1px solid rgb(130, 129, 125); border-radius:8px; box-shadow:0 3px 3px rgb(107, 106, 106)">
            <select name="monthSelect" id="monthSelect" class="form-select" style="width:130px;">
              @for ($i = 6; $i > 0; $i--)
              @php
              $date = now()->addMonths(($i-6));
              @endphp
              <option value="{{$date->format('M-Y')}}" <?php if ($date->format('M-Y') == session('dates'))
                echo "selected" ?>>
                  {{$date->format('M-Y')}}
                </option>
                @endfor
              </select>
              <button type="submit" id="submitBtn" name="submit"
                class="btn btn-warning btn-outline-success">Select</button>
            </div>
          </form>
        </li>
        <li class="nav-item dropdown notification">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->
    </ul>
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('uploads')}}/profile_img/{{Auth::user()->photo}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{Auth::user()->name}}</h6>
              <span>{{Auth::user()->role}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                href="#">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}"
                onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
              <form id="logout_form" action="{{route('logout')}}" method="POST">
                @csrf
              </form>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        <li class="nav-item pe-3 arrow-dropdown" onclick="showMediaHide()">
          <a class="nav-link nav-arrow" href="#">&#9207;</a>
        </li>
      </ul>
    </nav><!-- End Icons Navigation -->
  </header>
<script>
 function showMediaHide() {
      var mediaHide = document.getElementById('mediaHide');
      mediaHide.classList.toggle('show');
    }
    document.body.addEventListener('click', function (event) {
      var mediaHide = document.getElementById('mediaHide');
      var targetElement = event.target;

      // Check if the click is outside of mediaHide and the arrow-dropdown
      if (!mediaHide.contains(targetElement) && targetElement.className !== 'nav-link nav-arrow') {
        mediaHide.classList.remove('show');
      }
    });
</script>
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Profile Info - View/Update</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('profile.update')}}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="col-12">
              <div>
                <p style="text-align:center"><img src="{{asset('uploads')}}/profile_img/{{Auth::user()->photo}}"
                    alt="Profile" class="rounded-circle" style="width:200px; height:200px"></p>
              </div>
              <label for="name" class="form-label"><strong>Name</strong></label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-signature"></i></span>
                <input type="text" name="name" class="form-control" id="name" required autofocus autocomplete="name"
                  value="{{Auth::user()->name}}">
              </div>
            </div>
            <div class="col-12">
              <label for="username" class="form-label"><strong>Username</strong></label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-envelope"></i></span>
                <input type="username" name="username" class="form-control" id="username" autocomplete="username"
                  value="{{Auth::user()->username}}">
              </div>
            </div>
            <div class="col-12">
              <label for="email" class="form-label"><strong>Email</strong></label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" id="email" autocomplete="email"
                  value="{{Auth::user()->email}}">
              </div>
            </div>
            <div class="col-12">
              <label for="phone" class="form-label"><strong>Phone</strong></label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-phone"></i></span>
                <input type="text" name="phone" class="form-control" id="phone" required autocomplete="phone"
                  value="{{Auth::user()->phone}}">
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
              <label for="role" class="form-label"><strong>role</strong></label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-people-arrows"></i></span>
                <select name="role" id="role" class="form-control">
                  <option value="manager">manager</option>
                  <option value="mate">mate</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" value="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>