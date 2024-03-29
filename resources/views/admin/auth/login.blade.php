@extends('layouts.login')
@section('title','Admin Login')
@section('content')

<div class="limiter">

    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('assets/admin_login/images/img-01.png')}}" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="{{ route('admin.login') }}" method="post" novalidate >
                @csrf
                <span class="login100-form-title">
                    E-Commerce Admin

                </span>
                  <!-- begin alet section-->
   @include('admin.includes.alerts.error')
   @include('admin.includes.alerts.success')
   <!-- end alet section-->

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">

                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    @error('email')
                    <span class="text-danger">{{ $message }} </span>
                     @enderror
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    @error('password')
                    <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="#">
                        Username / Password?
                    </a>
                </div>


            </form>
            <div class="text-left p-t-80">
                <a class="txt2" href="#">
                    Developed By : Samer Alimoor
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
