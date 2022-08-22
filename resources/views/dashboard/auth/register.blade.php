@extends('layouts.dashboard')
@section('title', 'Login')
@section('Styles')
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('dashboard_asset/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('SideMenu')
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
                style="background-image: url({{ asset('dashboard_asset/media/bg/bg-3.jpg') }});">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{ asset('web_asset/images/logo.svg') }}" class="max-h-75px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>Sign In To Admin</h3>
                            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                        </div>
                        <form method="POST" action="{{ route('register') }}" class="form" id="kt_login_signin_form">
                            @csrf

                            <div class="form-group mb-5">

                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror  h-auto form-control-solid py-4 px-8"
                                    name="name" placeholder="name" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <input
                                    class="form-control @error('email') is-invalid @enderror h-auto form-control-solid py-4 px-8"
                                    type="text" placeholder="Email" name="email" autocomplete="off" />
                                @if ($errors->has('email'))
                                    <div class="fv-plugins-message-container">
                                        <div data-field="email" data-validator="notEmpty" class="fv-help-block">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-5">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror  h-auto form-control-solid py-4 px-8"
                                    name="password" required autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <input id="password-confirm" type="password"
                                    class="form-control  h-auto form-control-solid py-4 px-8" name="password_confirmation"
                                    required autocomplete="new-password" placeholder="Confirm Password">
                            </div>

                            <button type="submit" id=""
                                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
                                {{ __('Register') }}
                            </button>
                        </form>
                        {{-- <div class="mt-10">
                            <span class="opacity-70 mr-4">Don't have an account yet?</span>
                            <a href="{{ ('register') }}" id="kt_login_signup"
                                class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
                        </div> --}}
                    </div>
                    <!--end::Login Sign in form-->

                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
@endsection
