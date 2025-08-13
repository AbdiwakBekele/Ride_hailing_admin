<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="utf-8" />
    <title>Dashboard | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/css/style.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('assets/js/config.js')}}"></script>
    </head>
    <body>

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
                        <a href="#"  class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Users </span>
                            {{-- <span class="menu-arrow"></span> --}}
                        </a>
                      
                    </li>

                    <li class="menu-item">
                        <a href="#menuComponentsui" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Drivers </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuComponentsui">
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
                        <a href="#menuExtendedui" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Clients </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuExtendedui">
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
                        <a href="#menuIcons" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                            <span class="menu-icon"><i class="bx bx-file"></i></span>
                            <span class="menu-text"> Cars </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menuIcons">
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
           @yield(section: 'content')
           <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>

    <!-- Knob charts js -->
    <script src="{{asset('assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

    <!-- Sparkline Js-->
    <script src="{{asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

    <script src="{{asset('assets/libs/morris.js/morris.min.js')}}"></script>

    <script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>

    <!-- Dashboard init-->
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-validation.js')}}"></script>

      <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <!-- third party js ends -->

        <!-- Datatables js -->
        <script src="{{asset('assets/js/pages/datatables.js')}}"></script>
        
    </body>
</html>
    