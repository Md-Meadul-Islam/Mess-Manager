<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="{{asset('backend')}}/img/favicon.png" rel="icon">
            <link href="{{asset('backend')}}/img/apple-touch-icon.png" rel="apple-touch-icon">
          
            <!-- Google Fonts -->
            <link href="https://fonts.gstatic.com" rel="preconnect">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
          
            <!-- Vendor CSS Files -->
            <link href="{{asset('backend')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="{{asset('backend')}}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
            <!-- Template Main CSS File -->
            <link href="{{asset('backend')}}/css/style.css" rel="stylesheet">
            <link rel="stylesheet" href="{{asset('frontend')}}/style.css">
        <title>Mess Manager</title>
    </head>

    <body>
        <div>
          <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
              <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{asset('backend')}}/img/logo.png" alt="">
                <span class="d-none d-lg-block">Mess Manager</span>
              </a>
            </div><!-- End Logo -->
        
            <nav class="header-nav ms-auto">
              <ul class="d-flex align-items-center">
        
                <li class="nav-item d-block d-lg-none">
                  <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                  </a>
                </li><!-- End Search Icon-->
        
                <li class="nav-item dropdown">
        
                  <a class="nav-link nav-icon" title="FAQ" href="#faq" data-bs-toggle="dropdown">
                   <i class="bi bi-question-octagon-fill"></i>
                  </a><!-- End Notification Icon -->        
                </li><!-- End Notification Nav -->
                <li class="nav-item d-block">
                  @auth
                  <a class="nav-link px-2" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                    <span>Sign Out</span>
                  </a>
                  <form id="logout_form" action="{{route('logout')}}" method="POST">
                    @csrf      
                    </form>
                  @endauth
                   @guest
                   <a class="nav-link px-2" href="{{route('login')}}">Login</a>
                   @endguest
                </li>
                <li class="nav-item d-block">
                    <a class="nav-link px-2" href="{{route('register')}}">Register</a>
                </li>
                <li class="nav-item dropdown pe-3">
        
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{asset('uploads')}}/profile_img/default.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">Demo User</span>
                  </a><!-- End Profile Iamge Icon -->
        
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                      <h6>Demo User</h6>
                      <span>Role</span>
                    </li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
        
                    <li>
                      <a class="dropdown-item d-flex align-items-center"data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="#">
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
                  </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
        
              </ul>
            </nav><!-- End Icons Navigation -->
        </header>
        <section class="py-5">
          <div class="row">
            <div class="col-12 justify-content-center">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                      <div class="col-xxl-6 col-md-12 col-lg-6">
                        <div class="card">
                          <div class="card-body text-center">
                            <h1 class="card-title">Welcome to Mess Manager Application</h1>        
                            <div class="align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <a href="{{route('login')}}"class="btn btn-success btn-outline-">Log-In</a>
                                <a href="{{route('register')}}">Register</a>
                              </div>
                            </div>
                          </div>
      
                        </div>
                      </div>
                      <div class="col-xxl-6 col-md-12 col-lg-6">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="card-title">In-Total Bazar <span>| this Month</span></h5>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart-check-fill"></i>
                              </div>
                              <div class="ps-3">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                   
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>    
        </div>      
    </body>
    <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js"></script>
    <!-- Template Main JS File -->
    <script src="{{asset('backend')}}/js/main.js"></script>

</html>
