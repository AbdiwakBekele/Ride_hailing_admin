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
                                    <h4 class="page-title mb-0">update route</h4>
                                </div>
                                <div class="col-lg-6">
                                   <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                        <li class="breadcrumb-item active"></li>
                                    </ol>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title"></h4>
                                        <p class="sub-header"></p>

                                           
             <form class="needs-validation" method="POST" action="{{ route('routes.update', $route->id) }}" novalidate>
    @csrf 
    @method('PUT') <!-- Specify the PUT method for updates -->
<div class="mb-3">
    <label for="driver_id" class="form-label">Driver</label>
    <select class="form-select" id="driver_id" name="driver_id" required>
        <option value="" disabled>Select Driver</option>
        @foreach($drivers as $driver)
            <option value="{{ $driver->id }}" {{ $route->driver_id == $driver->id ? 'selected' : '' }}>
                {{ $driver->full_name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        Please select a valid driver.
    </div>
</div>
<div class="mb-3">
    <label for="client_id" class="form-label">Driver</label>
    <select class="form-select" id="client_id" name="client_id" required>
        <option value="" disabled>Select Client</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $route->client_id == $client->id ? 'selected' : '' }}>
                {{ $client->full_name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        Please select a valid client.
    </div>
</div>

    <div class="mb-3">
        <label for="validationCustom01" class="form-label">Pickup Location</label>
        <input type="text" class="form-control" id="validationCustom01" placeholder="pickup location" value="{{ old('pickup_location', $route->pickup_location) }}" name="pickup_location" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>

    <div class="mb-3">
        <label for="validationCustom02" class="form-label"de>Dropoff Location</label>
        <input type="text" class="form-control" id="validationCustom02" placeholder="dropoff location" value="{{ old('dropoff_location', $route->dropoff_location) }}" name="dropoff_location" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>

    <div class="mb-3">
        <label for="validationCustom03" class="form-label">pickup Time</label>
        <input type="datetime-local" class="form-control" id="validationCustom03" placeholder="pickup time" value="{{ old('pickup_time', $route->pickup_time) }}" name="pickup_time" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="mb-3">
        <label for="validationCustom03" class="form-label">Dropoff Time</label>
        <input type="datetime-local" class="form-control" id="validationCustom03" placeholder="dropoff time" value="{{ old('dropoff_time', $route->dropoff_time) }}" name="dropoff_time" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>

    <div class="mb-3">
        <label for="validationCustom04" class="form-label">Fare Amount</label>
        <input type="number" class="form-control" id="validationCustom04" placeholder="fare amount" value="{{ old('fare_amount', $route->fare_amount) }}" name="fare_amount" required>
        <div class="invalid-feedback">
            Please provide a valid Chassis Number.
        </div>
    </div>

    <div class="mb-3">
        <label for="distance_km" class="form-label">Distance Km</label>
        <input type="number" class="form-control" id="distance_km" placeholder="distance km" value="{{ old('distance_km', $route->distance_km) }}" name="distance_km" required>
        <div class="invalid-feedback">
            Please provide a valid Plate Number.
        </div>
    </div>

    
    <div class="mb-3">
        <label for="status" class="form-label">status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="" disabled>Select status</option>
            <option value="Completed" {{ $route->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Cancelled" {{ $route->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="In Progress" {{ $route->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
           
        </select>
        <div class="invalid-feedback">
            Please select a valid type.
        </div>
    </div>

    <button class="btn btn-primary" type="submit">Update Route</button> <!-- Changed button text -->
</form>


                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->


                           
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
       </div>
       </div>
       
@endsection