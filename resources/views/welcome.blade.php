<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('backend')}}/img/favicon.png" rel="icon">
    <link href="{{asset('backend')}}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">

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
        <nav class=" header-nav ms-auto align-middle justify-content-around">
          <ul class="d-flex">
            <li class="nav-item d-block">
              @auth
              <a class="nav-link px-2" href="{{route('logout')}}"
                onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
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
            <li class="nav-item d-block">
              <a class="nav-link px-2" title="FAQ" href="#faq" data-bs-toggle="dropdown">Faq</a>
            </li>
            <li class="nav-item d-block">
              <a class="nav-link px-2" title="Contacts" href="#contact" data-bs-toggle="dropdown">Contact</a>
            </li>

          </ul>
        </nav>
      </header>
      <section class="py-5">
        <div class="row">
          <div class="col-12">
            <div class="row justify-content-center px-3" style="height:100vh;">
              <div class="col-6 d-flex flex-row">
                <div class="card justify-content-center text-center" style="width:100%">
                  <h1 class="welcome">Welcome to <span>Mess Manager</span> Application</h1>
                  <div>
                    <a href="{{route('login')}}" class="btn btn-warning btn-outline-success px-5">Login</a>
                    <a href="{{route('register')}}" class="btn btn-success btn-outline-warning px-5">Register</a>
                  </div>
                </div>
              </div>
              <div class="col-6 d-flex flex-row">
                <div class="card justify-content-center text-center" style="width:100%">
                  <div class="video-wrapper">
                    <video id="IVideo">
                      <source src="{{asset('video')}}/intro.mp4">
                    </video>
                    <div id="playButton" class="playButton" onclick="playPause()"></div>
                    <div id="pauseButton" class="pauseButton" onclick="playPause()"></div>
                    <div id="replayButton" class="replayButton" onclick="playPause()"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section id="faq">
      welcome
    </section>
    </div>
  </body>
  <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('backend')}}/js/main.js"></script>
  <script src="{{asset('frontend')}}/welcome.js"></script>

</html>