<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.9, user-scalable=0, minimal-ui">
    <meta name="description" content="Organize your Messy Life. If you are in a Mess and if your mess has a Manager and some mess Members then this App is for you and your mess. Many things have to be calculated in the mess like Meal calculation, Bazar calculation, monthly Expenses, Other expenses like (Gas bill, Water bill), mess members leaving the mess and new members joining. You can calculate everything in this one App.">
    <meta name="keywords" content="mess, mess manager, mess apps,mess life, mess organize, room, roommate, roommates, room-mate, manager, member, blooms, blooms-ai.com, ">
    <meta name="author" content="Blooms-AI">
  <title>@yield('manager_title')</title>
  <!-- Favicons -->
  <link href="{{asset('backend')}}/img/favicon.png" rel="icon">
  <link href="{{asset('backend')}}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('backend')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('backend')}}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Template Main CSS File -->
  <link href="{{asset('backend')}}/css/style.css" rel="stylesheet">

  <!-- =======================================================
  ======================================================== -->
</head>

<body>
@if(Request::is('manager*', 'mate*'))
  <!-- ======= Header ======= -->
  @include('manager_mate_layouts.partials.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('manager_mate_layouts.partials.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('manager_mate.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">@yield('breadcrumb')</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endif
    <section class="section dashboard">

    @yield('manager_content')

    </section>

  </main><!-- End #main -->
@if(Request::is('manager*', 'mate*'))
  <!-- ======= Footer ======= -->
  @include('manager_mate_layouts.partials.footer')
<!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@endif
  <!-- Vendor JS Files -->
  <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js"></script>
  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Template Main JS File -->
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