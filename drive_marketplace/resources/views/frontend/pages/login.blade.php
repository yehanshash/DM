@extends('frontend.layouts.empty')

@section('title','E-Shop || Login Page')

@section('main-content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Shop Login -->
<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Login</h2>
                    <p>Use your credentials to access your account.</p>
                    <!-- Form -->
                    <form class="form" method="post" action="{{route('login.submit')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Email<span>*</span></label>
                                    <input type="email" name="email" placeholder="Email Address" required="required"
                                           value="{{old('email')}}">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Password<span>*</span></label>
                                    <input type="password" name="password" placeholder="Password" required="required"
                                           value="{{old('password')}}">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="checkbox col-12">
                                <label class="checkbox-inline ml-3" for="2"><input name="news" id="2" type="checkbox">Remember
                                    me</label>

                                @if (Route::has('password.request'))
                                <a class="lost-pass mr-3" href="{{ route('password.reset') }}">
                                    Lost your password?
                                </a>
                                @endif
                            </div>
                            <div class="col-12">
                                <div class="form-group login-btn mt-2">
                                    <button class="btn btn btn-primary btn-block" type="submit">Login</button>
                                    <!--                                        <a href="{{route('register.form')}}" class="btn">Register</a>-->
                                    <div class="line mt-5 mb-4 text-center">
                                        <span>OR </span>
                                    </div>
                                    <div class="text-center">
                                        <div class="d-inline-block mr-1">
                                            <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook"><i
                                                    class="ti-facebook"></i></a>
                                        </div>
                                        <div class="d-inline-block mr-1">
                                            <a href="{{route('login.redirect','github')}}" class="btn btn-github"><i
                                                    class="ti-github"></i></a>
                                        </div>
                                        <div class="d-inline-block">
                                            <a href="{{route('login.redirect','google')}}" class="btn btn-google"><i
                                                    class="ti-google"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 text-center mt-5">Don’t have an account? <a
                                        href="{{route('register.form')}}" style="color: #F7941D">Register here</a></div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Login -->
@endsection
@push('styles')
<style>
    .shop.login .form .btn {
        margin-right: 0;
    }

    .btn-facebook {
        background: #39579A;
    }

    .btn-facebook:hover {
        background: #073088 !important;
    }

    .btn-github {
        background: #444444;
        color: white;
    }

    .btn-github:hover {
        background: black !important;
    }

    .btn-google {
        background: #ea4335;
        color: white;
    }

    .btn-google:hover {
        background: rgb(243, 26, 26) !important;
    }
</style>
@endpush
