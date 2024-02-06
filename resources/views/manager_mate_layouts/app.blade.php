<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.9, user-scalable=0, minimal-ui">
    <meta name="description"
      content="Organize your Messy Life. If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess. Many things have to be calculated in the mess like Meal calculation, Bazar calculation, monthly Expenses, Other expenses like (Gas bill, Water bill), mess members leaving the mess and new members joining. You can calculate everything in this one App.">
    <meta name="keywords"
      content="Mess Manager, Meal Manager, Mess Management System, Meal Calculation, Meal Management, Mess To-let, Expense Manager, mess, mess manager, mess apps,mess life, mess organize, room, roommate, roommates, room-mate, manager, member, blooms, blooms-ai.com, ">
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Mess Manager App" />
    <meta property="og:title" content="Mess Manager App | Meal Manager App" />
    <meta property="og:description"
      content="Organize your Messy Life. If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess. | Mess Manager, Meal Manager, Mess Management System : Expense & Meal Calculation | Mess To-Let" />
    <meta property="og:image" content="https://www.messmanager.blooms-ai.com/img/logo.png" />
    <meta property="og:url" content="https://www.messmanager.blooms-ai.com/" />
    <meta itemprop="name" content="Mess Manager App | Meal Manager App" />
    <meta itemprop="description"
      content="মেসের মিলসহ যাবতীয় খরচ হিসাব করুন | Mess Manager, Meal Manager, Mess Management System : Expense & Meal Calculation | Mess To-Let" />
    <meta itemprop="image" content="https://www.messmanager.blooms-ai.com/img/logo.png" />
    <meta name="google-adsense-account" content="ca-pub-3304643762159808">
    <meta name="robots" content="index, follow">
    <meta name ="rating" content="adult">
    <meta name="author" content="Blooms-AI">
    <link rel="canonical" href="https://www.messmanager.blooms-ai.com/" />
    <title>@yield('manager_title')</title>
    <link href="{{asset('backend')}}/img/favicon.png" rel="icon">
    <link href="{{asset('backend')}}/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
      integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('backend')}}/css/style.css" rel="stylesheet">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3304643762159808"
      crossorigin="anonymous"></script>
  </head>

  <body>
    @if(Request::is('manager*', 'mate*'))
    @include('manager_mate_layouts.partials.header')
    @include('manager_mate_layouts.partials.sidebar')
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('manager_mate.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">@yield('breadcrumb')</li>
          </ol>
        </nav>
      </div>
      @endif
      <section class="section dashboard">
        @yield('manager_content')
      </section>
    </main>
    @if(Request::is('manager*', 'mate*'))
    @include('manager_mate_layouts.partials.footer')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
    @endif
    <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
      integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('backend')}}/js/main.js"></script>
    @if(Session::has('errors'))
    @foreach(Session::get('errors') as $error)
    <script>
      toastr.error("{{ addslashes($error) }}");
      toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

    </script>
    @endforeach
    @endif
    @if(Session::has('success'))
    <script>
      toastr.success("{{ Session::get('success') }}");
      toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    </script>
    @endif
  </body>

</html>