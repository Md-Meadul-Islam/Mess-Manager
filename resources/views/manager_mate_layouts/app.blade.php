<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('manager_title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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
  <link href="{{asset('backend')}}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset('backend')}}/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('backend')}}/js/main.js"></script>

</body>

</html>