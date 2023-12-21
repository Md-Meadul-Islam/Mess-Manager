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
          <a href="#" class="logo d-flex align-items-center">
            <img src="{{asset('backend')}}/img/logo.png" alt="">
            <span class="d-none d-lg-block">Mess Manager</span>
          </a>
        </div><!-- End Logo -->
        <nav class="header-nav mx-auto">
          <ul class="d-flex justify-content-center">
            <li class="nav-item d-block">
              <a class="nav-link px-2" title="Home" href="#intro">Home</a>
            </li>
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
              <a class="nav-link px-2" title="FAQ" href="#faq">Faq</a>
            </li>
            <li class="nav-item d-block">
              <a class="nav-link px-2" title="Contacts" href="#contact">Contact</a>
            </li>

          </ul>
        </nav>
      </header>
      <section id="intro" class="intro py-5" name="intro">
        <div class="row">
          <div class="col-12">
            <div class="row justify-content-center px-3" style="height:100vh;">
              <div class="col-6 d-flex">
                <div class="left-side-intro">
                  <h1 class="welcome">Welcome to <span>Mess Manager</span> Application</h1>
                  <div>
                    <a href="{{route('login')}}" class="btn btn-warning btn-outline-success px-5">Login</a>
                    <a href="{{route('register')}}" class="btn btn-success btn-outline-warning px-5">Register</a>
                  </div>
                </div>
              </div>
              <div class="col-6 d-flex">
                <div class="video-wrapper">
                  <video id="IVideo">
                    <source src="{{asset('video')}}/intro.mp4">
                  </video>
                  <div id="playButton" class="playButton" onclick="playPause()"></div>
                  <div id="pauseButton" class="pauseButton" onclick="playPause()"></div>
                  <div id="replayButton" class="replayButton" onclick="playPause()"></div>
                </div>
                {{-- <div class="card justify-content-center text-center" style="width:100%">
                  
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="faq" name="faq">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <h1 class="text-center" style="font-family: cursive; font-weight:600">Frequently Asked Question</h1>
              <div class="card m-2 p-3">
                @php
                    $faqJson = File::get(base_path('public/JSON/faq.json'));
                    $faqData = json_decode($faqJson);
                @endphp
                @foreach ($faqData as $key=>$faq)
                <div class="faq-content">
                  <div class="faq-header p-2">
                    <h4 style="position: relative">{{$faq->title}}<span
                        style="position: absolute; right:5px"><i class="fa-solid fa-angle-down"></i></span></h4>
                  </div>
                  <div class="faq-body">
                    <p>{!! $faq->body !!}</p>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
      <footer id="contact" class="footer" name="contact">
        <div class="copyright">
          &copy; Copyright-{{now()->format('Y')}}<strong><span>Mess Manager Application</span></strong>. All Rights
          Reserved
        </div>
        <div class="credits">
          Designed by <a href="#"><strong>Blooms-AI</strong></a>
        </div>
      </footer>
    </div>
  </body>
  <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('backend')}}/js/main.js"></script>
  <script src="{{asset('frontend')}}/welcome.js"></script>

</html>