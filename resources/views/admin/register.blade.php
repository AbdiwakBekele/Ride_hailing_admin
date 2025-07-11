@extends('layouts.layout')
@section('content')
<div class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
<div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a href="index.html" class="logo-dark">
                                <span><img src="assets/images/logo_ride.jpg" alt="" style="width:full; height:50px"></span>
                            </a>

                            <a href="index.html" class="logo-light">
                                <span><img src="assets/images/logo_ride.jpg" alt="" style="width:full; height:50px;"></span>
                            </a>
                        </div>

                       <form action="{{route('admin.register.submit')}}" method="POST">
                                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" type="text" id="name" name="name" required="" placeholder="Enter your Name">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="emailaddress"  >Email  address</label>
                                <input class="form-control" type="email" id="emailaddress" required=""name="email" placeholder="Enter your email">
                            </div>

                            <div class="form-group mb-3">
                                <a href="pages-recoverpw.html" class="text-muted float-end"><small></small></a>
                                <label class="form-label" for="password" >Password</label>
                                <input class="form-control" type="password" required="" name="password"  id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-3">
                                <div class="">
                                    <input class="form-check-input" type="checkbox" id="checkbox-signin" checked>
                                    <label class="form-check-label ms-2" for="checkbox-signin">I accept <a href="#">Terms and Conditions</a></label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-100" type="submit"> Sign Up </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">                        
                        <p class="text-white-50">Already have an account ? <a href="{{route('admin.login')}}" class="text-white font-weight-medium ms-1">Log In</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    </div>
        @endsection