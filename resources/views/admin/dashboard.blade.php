@extends('layouts.layout')
@section('content')
  <div class="layout-wrapper">
      <div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="index.html" class="logo-light">
                    <img src="{{asset('assets/images/logo_ride.jpg')}}" alt="logo" class="logo-lg" style="width:140px; height:70px; border: none; border-radius: 5%;" >
                    {{-- <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28"> --}}
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <img src="{{asset('assets/images/logo_ride.jpg')}}" alt="dark logo" class="logo-lg" style="width:140px; height:70px; border: none; border-radius:5%;"  >
                    {{-- <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28"> --}}
                </a>
            </div>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">

                    <li class="menu-title">Menu</li>

                    <li class="menu-item">
                        <a href="index.html" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                            <span class="menu-text"> Dashboards </span>
                            <span class="badge bg-primary rounded ms-auto">01</span>
                        </a>
                    </li>

                    <li class="menu-title">Custom</li>

                    <li class="menu-item">
                        <a href="apps-calendar.html" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-calendar"></i></span>
                            <span class="menu-text">Manage Rides </span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Users </span>
                            {{-- <span class="menu-arrow"></span> --}}
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="pages-starter.html" class="menu-link">
                                        <span class="menu-text">Starter</span>
                                    </a>
                                </li>
                                {{-- <li class="menu-item">
                                    <a href="pages-invoice.html" class="menu-link">
                                        <span class="menu-text">Invoice</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="pages-login.html" class="menu-link">
                                        <span class="menu-text">Log In</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="pages-register.html" class="menu-link">
                                        <span class="menu-text">Register</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="pages-recoverpw.html" class="menu-link">
                                        <span class="menu-text">Recover Password</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="pages-lock-screen.html" class="menu-link">
                                        <span class="menu-text">Lock Screen</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="pages-404.html" class="menu-link">
                                        <span class="menu-text">Error 404</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="pages-500.html" class="menu-link">
                                        <span class="menu-text">Error 500</span>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Drivers </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                     <a href="{{ route('drivers.index') }}" class="menu-link">
                                        <span class="menu-text">View drivers</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                     <a href="{{ route('drivers.create') }}" class="menu-link">
                                        <span class="menu-text">Add drivers</span>
                                    </a>
                                </li>
                             
                            </ul>
                        </div>
                    </li>

                    <li class="menu-title">Components</li>

                 <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Clients </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                     <a href="{{ route('clients.index') }}" class="menu-link">
                                        <span class="menu-text">View clients</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                     <a href="{{ route('clients.create') }}" class="menu-link">
                                        <span class="menu-text">Add clients</span>
                                    </a>
                                </li>
                             
                            </ul>
                        </div>
                    </li>

                     <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Cars </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                     <a href="{{ route('cars.index') }}" class="menu-link">
                                        <span class="menu-text">View cars</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                     <a href="{{ route('cars.create') }}" class="menu-link">
                                        <span class="menu-text">Add cars</span>
                                    </a>
                                </li>
                             
                            </ul>
                        </div>
                    </li>

                  <li class="menu-item">
                        <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Routes </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExpages">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                     <a href="{{ route('routes.index') }}" class="menu-link">
                                        <span class="menu-text">View routes</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                     <a href="{{ route('routes.create') }}" class="menu-link">
                                        <span class="menu-text">Add routes</span>
                                    </a>
                                </li>
                             
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item">
                        <a href="#menuForms" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bxs-eraser"></i></span>
                            <span class="menu-text"> Payments </span>
                            {{-- <span class="menu-arrow"></span> --}}
                        </a>
                        <div class="collapse" id="menuForms">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="forms-elements.html" class="menu-link">
                                        <span class="menu-text">General Elements</span>
                                    </a>
                                </li>
                              
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item">
                        <a href="#menuTables" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-table"></i></span>
                            <span class="menu-text"> Reports </span>
                            {{-- <span class="menu-arrow"></span> --}}
                        </a>
                      
                    </li>

                    <li class="menu-item">
                        <a href="#menuCharts" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-doughnut-chart"></i></span>
                            <span class="menu-text"> Settings </span>
                            {{-- <span class="menu-arrow"></span> --}}
                        </a>
                        <div class="collapse" id="menuCharts">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="charts-apex.html" class="menu-link">
                                        <span class="menu-text">Apex Charts</span>
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                    </li>

                   
                </ul>
            </div>
        </div>
         <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">
               <!-- ========== Topbar Start ========== -->
            <div class="navbar-custom">
                <div class="topbar">
                    <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                        <!-- Brand Logo -->
                        <div class="logo-box">
                            <!-- Brand Logo Light -->
                            <a href="index.html" class="logo-light">
                                <img src="assets/images/logo-light.png" alt="logo" class="logo-lg" height="22">
                                <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                            </a>

                            <!-- Brand Logo Dark -->
                            <a href="index.html" class="logo-dark">
                                <img src="assets/images/logo-dark.png" alt="dark logo" class="logo-lg" height="22">
                                <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-4">

                        <li class="d-none d-md-inline-block">
                            <a class="nav-link" href="" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen font-size-24"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-magnify font-size-24"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                                <form class="p-3">
                                    <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>


                        <li class="dropdown d-none d-md-inline-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{asset('assets/images/flags/us.jpg')}}" alt="user-image" class="me-0 me-sm-1" height="18">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{asset('assets/images/flags/italy.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{asset('assets/images/flags/spain.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="{{asset('assets/images/flags/russia.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell font-size-24"></i>
                                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                                <small>Clear All</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-1" style="max-height: 300px;" data-simplebar>

                                    <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                                    <!-- item-->

                                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-info">
                                                        <i class="mdi mdi-account-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                                    <small class="noti-item-subtitle text-muted">New user registered</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <h5 class="text-muted font-size-13 fw-normal mt-0">Yesterday</h5>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon">
                                                        <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                                    <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <h5 class="text-muted font-size-13 fw-normal mt-0">30 Dec 2021</h5>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Datacorp</h5>
                                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon">
                                                        <img src="assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-size-14">Karen Robinson</h5>
                                                    <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="text-center">
                                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="nav-link" id="theme-mode">
                            <i class="bx bx-moon font-size-24"></i>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{asset('assets/images/users/avatar-4.jpg')}}" alt="user-image" class="rounded-circle">
                                <span class="ms-1 d-none d-md-inline-block">
                                    Jamie D. <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                    <i class="fe-lock"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="pages-login.html" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </li>
          
                    </ul>
                </div>
            </div>
              <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">Dashboard</h4>
                            </div>
                            <div class="col-lg-6">
                               <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashtrap</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                               </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Daily</span>
                                        <h5 class="card-title mb-0">Driver Performance</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                $171.21
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">12.5% <i
                                                    class="mdi mdi-arrow-up text-success"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Per Week</span>
                                        <h5 class="card-title mb-0">Revenue Overview</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                $1875.54
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">18.71% <i
                                                    class="mdi mdi-arrow-up text-success"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Daily</span>
                                        <h5 class="card-title mb-0">Recent Bookings</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                $784.62
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">57% <i
                                                    class="mdi mdi-arrow-up text-success"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div>
                            <!--end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">All Time</span>
                                        <h5 class="card-title mb-0">Daily Visits</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                1,15,187
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">17.8% <i
                                                    class="mdi mdi-arrow-up text-success"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->


                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Earnings Growth</h4>
                                    <p class="card-subtitle mb-4">From date of 1st Jan 2020 to continue</p>
                                    <div id="morris-bar-example" class="morris-chart"></div>
                                </div> <!--end card body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ride Trends</h4>
                                    <p class="card-subtitle mb-4">Recent Ride</p>

                                    <div class="text-center">
                                        <input data-plugin="knob" data-width="165" data-height="165" data-linecap=round
                                            data-fgColor="#7a08c2" value="95" data-skin="tron" data-angleOffset="180"
                                            data-readOnly=true data-thickness=".15" />
                                        <h5 class="text-muted mt-3">Total ride made today</h5>


                                        <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading
                                            elements are
                                            designed to work best in the meat of your page content.</p>

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                                <h4><i class="fas fa-arrow-up text-success me-1"></i>$7.8k</h4>

                                            </div>
                                            <div class="col-6">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                                <h4><i class="fas fa-arrow-down text-danger me-1"></i>$1.4k</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div> <!--end card body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="card-title">Booking Analytics</h4>
                                            <p class="card-subtitle mb-4">Transaction period from 21 July to
                                                25 Aug</p>
                                            <h3>$7841.12 <span class="badge badge-soft-success float-end">+7.5%</span>
                                            </h3>
                                        </div>
                                    </div> <!-- end row -->

                                    <div id="sparkline1" class="mt-3"></div>
                                </div>
                                <!--end card body-->
                            </div>
                            <!--end card-->

                        </div><!-- end col -->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-end position-relative">
                                        <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#" class="dropdown-item">Action</a></li>
                                            <li><a href="#" class="dropdown-item">Another action</a></li>
                                            <li><a href="#" class="dropdown-item">Something else here</a></li>
                                            <li class="dropdown-divider"></li>
                                            <li><a href="#" class="dropdown-item">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="card-title d-inline-block">Total Revenue</h4>

                                    <div id="morris-line-example" class="morris-chart" style="height: 290px;"></div>

                                    <div class="row text-center mt-4">
                                        <div class="col-6">
                                            <h4>$7841.12</h4>
                                            <p class="text-muted mb-0">Total Revenue</p>
                                        </div>
                                        <div class="col-6">
                                            <h4>17</h4>
                                            <p class="text-muted mb-0">Open Compaign</p>
                                        </div>
                                    </div>

                                </div>
                                <!--end card body-->

                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Top 5 Customers</h4>
                                    <p class="card-subtitle mb-4 font-size-13">Transaction period from 21 July to 25 Aug
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-centered table-striped table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Location</th>
                                                    <th>Create Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Paul J. Friend</a>
                                                    </td>
                                                    <td>
                                                        937-330-1634
                                                    </td>
                                                    <td>
                                                        pauljfrnd@jourrapide.com
                                                    </td>
                                                    <td>
                                                        New York
                                                    </td>
                                                    <td>
                                                        07/07/2018
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Bryan J. Luellen</a>
                                                    </td>
                                                    <td>
                                                        215-302-3376
                                                    </td>
                                                    <td>
                                                        bryuellen@dayrep.com
                                                    </td>
                                                    <td>
                                                        New York
                                                    </td>
                                                    <td>
                                                        09/12/2018
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-8.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Kathryn S.
                                                            Collier</a>
                                                    </td>
                                                    <td>
                                                        828-216-2190
                                                    </td>
                                                    <td>
                                                        collier@jourrapide.com
                                                    </td>
                                                    <td>
                                                        Canada
                                                    </td>
                                                    <td>
                                                        06/30/2018
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Timothy Kauper</a>
                                                    </td>
                                                    <td>
                                                        (216) 75 612 706
                                                    </td>
                                                    <td>
                                                        thykauper@rhyta.com
                                                    </td>
                                                    <td>
                                                        Denmark
                                                    </td>
                                                    <td>
                                                        09/08/2018
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-5.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Zara Raws</a>
                                                    </td>
                                                    <td>
                                                        (02) 75 150 655
                                                    </td>
                                                    <td>
                                                        austin@dayrep.com
                                                    </td>
                                                    <td>
                                                        Germany
                                                    </td>
                                                    <td>
                                                        07/15/2018
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!--end card body-->

                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->

                    </div>
                    <!--end row-->

                </div> <!-- container -->

            </div> <!-- content -->
       </div>
       </div>
       
@endsection