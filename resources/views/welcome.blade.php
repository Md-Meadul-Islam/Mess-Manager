<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.9, user-scalable=0, minimal-ui">
    <meta name="description"
      content="Organize your Messy Life. Create Mess To-Let. If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess.">
    <meta name="keywords"
      content="mess manager, meal manager, bachelor life, bachelor, meal Calculation, meal management, mess to-let, to let, to-let, expense manager, mess, mess manager app, mess life, mess organize, room, roommate, roommates, room-mate, manager, member, blooms, blooms-ai.com">
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="To-Let & Mess Manager" />
    <meta property="og:title" content="To-Let & Mess Manager" />
    <meta property="og:description"
      content="Organize your Messy Life. Create Mess To-Let. If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess."/>
    <meta property="og:image" content="https://www.messmanager.blooms-ai.com/img/logo.png" />
    <meta property="og:url" content="https://www.messmanager.blooms-ai.com/" />
    <meta itemprop="name" content="To-Let & Mess Manager" />
    <meta itemprop="description"
      content="Organize your Messy Life. Create Mess To-Let | মেসের মিলস, বাজারসহ যাবতীয় খরচ হিসাব করুন কোনো ঝামেলা ছাড়াই! " />
    <meta itemprop="image" content="https://www.messmanager.blooms-ai.com/img/logo.png" />
    <meta name="google-adsense-account" content="ca-pub-3304643762159808">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="adult">
    <meta name="author" content="Blooms-AI">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://www.messmanager.blooms-ai.com/" />
    <link href="{{asset('backend')}}/img/favicon.png" rel="icon">
    <link href="{{asset('backend')}}/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="{{asset('backend')}}/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend')}}/style.css">
    <title>To-Let & Mess Manager</title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3304643762159808"
      crossorigin="anonymous"></script>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
  </head>

  <body>
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
          <img src="{{asset('backend')}}/img/logo.png" alt="TL & M">
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
            <a class="nav-link px-2" title="To Let" href="#tolet">To-Let</a>
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
        <p class="d-flex align-items-center my-5 pe-5" style="font-weight:800" title="User Name">
          {{Auth::user()->name}}
        </p>
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
                <p class="welcome" style="font-size: 2rem">Welcome to</p>
                <h1 style="color:rgb(56, 88, 170); font-family:fantasy;">To-Let & Mess Manager</h1>
                <h4>Organize your Bachelor Life.</h4>
                <div>
                  @auth
                  <a href="{{route('logout')}}" class="btn btn-warning btn-outline-success px-5 my-2"
                    onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Sign Out</a>
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
    <section class="tolet" id="tolet" name="tolet" style="padding-top: 5.5rem">
      <h2 class="text-center" style="font-family: fantasy,cursive; letter-spacing:1px; color:rgb(125, 151, 141);">
        To-Let</h2>
      <div class="col-12 px-3">
        <div class="row">
          <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-around">
            <div>
              <button type="submit" class="btn toletAddBtn" style="background-color:rgb(56, 88, 170); color:white">Add
                To-Let</button>
            </div>
            <div class="mx-3 position-relative searchContainer">
              <div class="searchDiv position-relative">
                <input id="search" class="searchString form-control border-2 border-secondary py-3 px-4 rounded-pill"
                  type="text" placeholder="Search">
                <button type="submit" id="mainsearch"
                  class="btn btn-primary border-2 border-secondary py-3 position-absolute rounded-pill text-white h-100"
                  style="top:0; right:0; width:4rem"><i class="fas fa-search"></i>
                </button>
              </div>
              <div class="resultBox">
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 text-start align-items-center">
            <div>
              <p class="text-center">Result produce based on Your Area-</p>
            </div>
            <div class="d-flex justify-content-center align-items-center">
              <p class="text-center" style="font-family: fantasy;">
                <span class="village"></span> >
                <span class="town"></span> >
                <span class="city"></span> >
                <span class="country"></span>
              </p>
            </div>
          </div>
        </div>
        <style>
          .addtolet {
            display: none;
            scroll-behavior: smooth;
            transition: .25s ease-out;
          }

          .show {
            display: block;
            scroll-behavior: smooth;
            transition: .25s ease-in;
          }
        </style>
        <div class="row p-2">
          <div class="col-12">
            <div class="row d-flex position-relative" style="z-index: 500">
              <div class="col-lg-4 col-md-6 col-sm-12 addtolet" style="position: absolute;z-index:501">
                <div class="card">
                  <div class="card-body">
                    <div class="col-12">
                      <label for="title" class="form-label"><strong>Title</strong><span
                          style="color:red;padding-left:5px">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i
                            class="fa-solid fa-signature"></i></span>
                        <input type="text" name="title" class="form-control" id="title" required autofocus
                          autocomplete="title" placeholder="eg. {{__('Roommate Require')}}">
                      </div>
                    </div>
                    <div class="col-12">
                        <label for="month" class="form-label"><strong>{{__('Month From')}}</strong><span
                            style="color:red;padding-left:5px">*</span></label>
                        <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend">📅</span>
                        <select name="month" id="month" class="form-select">
                          @for ($i = 0; $i <6; $i++) @php $date=now()->addMonths(($i));
                            @endphp
                            <option value="{{$date->format('M-Y')}}" <?php if (
                              $date->format('M-Y') ==
                              now()->format('M-Y')
                            )
                              echo "selected" ?>>
                                {{$date->format('M-Y')}}
                              </option>
                              @endfor
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="details" class="form-label"><strong>{{__('Details')}}</strong><span
                            style="color:red;padding-left:5px">*</span></label>
                        <div class="input-group">
                          <span class="input-group-text" id="inputGroupPrepend">📜</span>
                          <textarea name="details" id="details" class="form-control"
                            placeholder="eg. {{__('Student, Job Holder etc.')}}" required></textarea>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="address" class="form-label"><strong>{{__('Address')}}</strong><span
                            style="color:red;padding-left:5px">*</span></label>
                        <div class="input-group">
                          <span class="input-group-text" id="inputGroupPrepend">🏖</span>
                          <textarea name="address" id="address" class="form-control"
                            placeholder="eg. {{__('Block-D, Road-12, Moghbazar, Dhaka.')}}" required></textarea>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="contact" class="form-label"><strong>{{__('Contact')}}</strong> <span
                            style="color:red;padding-left:5px">*</span></label>
                        <div class="input-group">
                          <span class="input-group-text" id="inputGroupPrepend">📠</span>
                          <input type="text" name="contact" class="form-control" id="contact" required
                            placeholder="{{__('Your detailed Contact')}}">
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="photo1" class="form-label"><strong>{{__('Room Photo-1')}}</strong> <span
                            style="color: red; font-size:10px; align-items:right">Max-Size: 3MB</span></label>
                        <div class="input-group">
                          <span class="input-group-text" id="inputGroupPrepend">🕍</span>
                          <input type="file" name="photo1" class="form-control" id="photo1" accept="image/*">
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="photo2" class="form-label"><strong>{{__('Room Photo-2')}}</strong> <span
                            style="color: red; font-size:10px; align-items:right">Max-Size: 3MB</span></label>
                        <div class="input-group">
                          <span class="input-group-text" id="inputGroupPrepend">🕍</span>
                          <input type="file" name="photo2" class="form-control" id="photo2" accept="image/*">
                        </div>
                      </div>
                      <div class="col-12 p-2 d-flex justify-content-center">
                        <button class="btn btn-success btn-outline-warning w-50 saveBtn" type="submit">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row viewtolets d-flex justify-content-center align-items-center">
                <style>
                  .loader {
                      border: 2px solid;
                      border-color: transparent #FFF;
                      width: 48px;
                      height: 48px;
                      border-radius: 50%;
                      display: inline-block;
                      position: relative;
                      box-sizing: border-box;
                      animation: rotation 2s linear infinite;
                    }
                    .loader::after {
                      content: '';  
                      box-sizing: border-box;
                      position: absolute;
                      left: 50%;
                      top: 50%;
                      border: 24px solid;
                      border-color: transparent rgba(255, 255, 255, 0.15);
                      border-radius: 50%;
                      transform: translate(-50%, -50%);
                    }

                    @keyframes rotation {
                      0% {
                        transform: rotate(0deg);
                      }
                      100% {
                        transform: rotate(360deg);
                      }
                    } 
                </style>
                <span class="loader"></span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="about" id="about" name="about">
        <div class="row">
          <div class="p-3">
            <div class="row d-flex">
              <div class="col-md-6 col-sm-12">
                <h2 class="text-center"
                  style="font-family: fantasy,cursive; letter-spacing:1px; color:rgb(125, 151, 141);">About</h2>
                <div class="dashboardbackground">
                  <video src="./frontend/files/dashboard.mp4" autoplay muted loop></video>
                  <div class="card-body">
                    <p style="text-align: justify; place-items:center">
                      {{__('If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess. Many things have to be calculated in the mess like Meal calculation, Bazar calculation, monthly Expenses, Other expenses like (Gas bill, Water bill), mess members leaving the mess and new members joining. You can calculate everything in this one App.')}}
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <h2 class="text-center"
                  style="font-family: fantasy,cursive; letter-spacing:1px; color:rgb(125, 151, 141);">Features</h2>
                <h5 style="font-style: italic; font-weight:bold; padding-left:2rem">Why Choose Us?</h5>
                <div class="features">
                  <ul class="nav-item">
                    <li class="nav-link"><span style="color: green">✔</span> Bazar Table: you can add your daily bazar
                      and it calculated automatically.</li>
                    <li class="nav-link"><span style="color: green">✔</span> Meal Table: update your specific date's
                      meal data in meal table. Counted it's automatically.</li>
                    <li class="nav-link"><span style="color: green">✔</span> Fully automated and onlined. So, you can
                      view, edit, update any time.</li>
                    <li class="nav-link"><span style="color: green">✔</span> Current and past's all month's mess data
                      you can retrieve any time.</li>
                    <li class="nav-link"><span style="color: green">✔</span> Manager can Add/Delete a member any time,
                      and any Member who want to add he can entry in a mess with create an account.</li>
                    <li class="nav-link"><span style="color: green">✔</span> With manager's permission, member's can
                      change their manager.</li>
                    <li class="nav-link"><span style="color: green">✔</span> Notification Support.</li>
                    <li class="nav-link"><span style="color: green">✔</span> Adding To-Let.</li>
                    <li class="nav-link"><span style="color: green">✔</span> 24/7 supports. Any concern, knock with
                      facebook or youtube.</li>

                  </ul>
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
                      <h4 style="position: relative">{!!__($faq->title)!!}<span style="position: absolute; right:5px"><i
                            class="fa-solid fa-angle-down"></i></span></h4>
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
                  <a href="https://www.linkedin.com/company/to-let-mess-manager" class="btn btn-secondary" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                  <a href="https://www.facebook.com/profile.php?id=61556546065353" class="btn btn-secondary"
                    target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
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
      <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js"></script>
      <script src="{{asset('backend')}}/js/main.js"></script>
      <script src="{{asset('frontend')}}/welcome.js"></script>
      @include('tolets.toletajax_js')
      <script>
        var suggestions = [];
        document.addEventListener("DOMContentLoaded", function () {
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "{{ route('searchKey') }}", true);
          xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
              suggestions = JSON.parse(xhr.responseText);
            }
          };
          xhr.send();
        });
        const searchInput = document.querySelector(".searchDiv");
        const input = searchInput.querySelector(".searchString");
        const resultBox = document.querySelector(".resultBox");
        const li = resultBox.querySelectorAll('li');
        input.onkeyup = (e) => {
          let userData = e.target.value;
          let emptyArray = [];
          if (userData) {
            emptyArray = suggestions.filter((data) => {
              return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
            });
            emptyArray = emptyArray.map((data) => {
              return data = '<li>' + data + '</li>';
            });
            resultBox.style.display = 'block'
            showSuggestions(emptyArray);
            let allList = resultBox.querySelectorAll("li");
            for (let i = 0; i < allList.length; i++) {
              allList[i].setAttribute("onclick", "select(this)");
            }
          } else {
            resultBox.style.display = 'none';
          }
        }
        function showSuggestions(list) {
          let listData;
          if (!list.length) {
            userValue = input.value;
            listData = '<li>' + userValue + '</li>';
          } else {
            listData = list.join('');
          }
          resultBox.innerHTML = listData;
        }
        function select(d) {
          input.value = d.innerHTML;
          resultBox.style.display = 'none';
        }
      </script>
      {{-- {!! Toastr::message() !!} --}}
    </body>

  </html>