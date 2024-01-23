<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.9, user-scalable=0, minimal-ui">
    <meta name="description" content="Organize your Messy Life. If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess. Many things have to be calculated in the mess like Meal calculation, Bazar calculation, monthly Expenses, Other expenses like (Gas bill, Water bill), mess members leaving the mess and new members joining. You can calculate everything in this one App.">
    <meta name="keywords" content="mess, mess manager, mess apps,mess life, mess organize, room, roommate, roommates, room-mate, manager, member, blooms, blooms-ai.com, ">
    <meta name="author" content="Blooms-AI">
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
            <img src="{{asset('backend')}}/img/logo.png" alt="M">
            <span class="d-none d-lg-block">Mess Manager</span>
          </a>
        </div><!-- End Logo -->
        
        <nav class="header-nav mx-auto d-flex">
          <ul class="d-flex flex-start justify-content-center">
            <li class="nav-item d-block">
              <a class="nav-link px-2" title="Home" href="#intro">Home</a>
            </li>
            <li class="nav-item d-block">
              @auth
              <a class="nav-link px-2" href="{{route('manager_mate.dashboard')}}">Dashboard</a>
              @endauth
            </li>
            <li class="nav-item d-block">
              <a class="nav-link px-2" title="FAQ" href="#doc">Doc</a>
            </li>
            <li class="nav-item d-block">
              <a class="nav-link px-2" title="Contacts" href="#contact">Contact</a>
            </li>

          </ul>
        </nav>
        <div class="d-flex align-items-center justify-content-between">
          @auth
          <p class="d-flex align-items-center my-5 pe-5"style="font-weight:800" title="User Name">{{Auth::user()->name}}</p>
          @endauth
        </div>
        
      </header>
      <div class="toggle-btn d-flex" onclick="toggleNav()">
        <i class="bi bi-list"></i>
      </div>
      <section id="intro" class="intro py-5" name="intro">
        <div class="row">
          <div class="col-12">
            <div class="row justify-content-center px-3" style="height:100vh;">
              <div class="col-xxl-6 col-lg-6 col-md-12 d-flex">
                <div class="left-side-intro">
                  <h1 class="welcome">Welcome to <span style="color:rgb(56, 88, 170)">Mess Manager</span> Application</h1>
                  <h4>Organize your messy life.</h4>
                  <div>
                    @auth
                    <a href="{{route('logout')}}" class="btn btn-warning btn-outline-success px-5 my-2" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Sign Out</a>
                    @endauth
                    <form id="logout_form" action="{{route('logout')}}" method="POST">
                      @csrf
                    </form>
                   @guest
                   <a href="{{route('login')}}" class="btn btn-warning btn-outline-success px-5 my-2">Login</a>
                   <a href="{{route('register')}}" class="btn btn-success btn-outline-warning px-5 my-2">Register</a>
                   @endguest                    
                  </div>
                </div>
              </div>
              <div class="col-xxl-6 col-lg-6 col-md-12 d-flex">
                <div class="video-wrapper">  
                  <video controls muted>
                    <source src="{{asset('frontend')}}/files/Mess_Manager_intro.webm">
                  </video>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="row">
          <div class="col-12">
            <div class="">
              <div class="card-body">
                <h2 class="text-center" style="font-family: fantasy,cursive; letter-spacing:1px; color:rgb(125, 151, 141);">{{__('If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess. Many things have to be calculated in the mess like Meal calculation, Bazar calculation, monthly Expenses, Other expenses like (Gas bill, Water bill), mess members leaving the mess and new members joining. You can calculate everything in this one App.')}}</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>        
        <div class="row">
          <div class="col-xxl-8 col-lg-6 col-md-12" id="doc" name="doc">
            <div class="card">           
              <div class="card-body">
                <h5 class="card-title" style="font-family: fantasy;">FAQ <span>/ Documentations</span></h5>
                <div class="">
                  @php
                      $faqJson = File::get(base_path('public/JSON/faq.json'));
                      $faqData = json_decode($faqJson);
                  @endphp
                  @foreach ($faqData as $key=>$faq)
                  <div class="faq-content">
                    <div class="faq-header p-2">
                      <h4 style="position: relative">{!!__($faq->title)!!}<span
                          style="position: absolute; right:5px"><i class="fa-solid fa-angle-down"></i></span></h4>
                    </div>
                    <div class="faq-body pt-2">
                      <p>{!!__($faq->body)!!}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>            
          <div class="col-xxl-4 col-lg-6 col-md-12" id="contact" name="contact">
            <div class="card">
              <h1 class="text-center" style="font-family: fantasy; color:rgb(125, 151, 141);">Contact</h1>
              <div class="card m-2">
                <div class="input-group p-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                  </div>
                  <a href="#" class="p-2">mdmeadulislam@gmail.com</a>
                </div>
                <div class="input-group p-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-outbound-fill"></i></span>
                  </div>
                  <a href="#" class="p-2">+8801862151631</a>
                </div>
                <div class="p-2">
                    <a href="#" class="btn btn-secondary"title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100077053114517" class="btn btn-secondary" target="_blank"title="Facebook"><i class="bi bi-facebook"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <footer class="footer">
        <div class="copyright">
          &copy; Copyright-{{now()->format('Y')}}<strong><span> Mess Manager Application</span></strong>. All Rights
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