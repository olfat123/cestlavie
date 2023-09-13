@extends('layouts.admin.app')
@section('title','Reset Password')
@section('styles')
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <link type="text/css" href="{{
        LaravelLocalization::getCurrentLocaleDirection() == 'rtl'
        ? asset('assets/admin/css/login-rtl.css')
        : asset('assets/admin/css/login.css')
    }}" rel="stylesheet"/>
    @yield('d-styles')
@endsection
@section('content')
@section('body_class','login_page')
<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            <div class="login_heading">
                <h3>Reset Password</h3>
            </div>
            <form class="ajax" id="forgot" method="POST" action="{{route('password.update')}}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="uk-form-row">
                    <label for="login_username">New Password</label>
                    <input class="md-input" type="password" id="login_password" name="password"/>
                    @include('layouts.partials.form-errors', ['field'=>'password'])
                </div>
                <div class="uk-form-row">
                    <label for="login_username">Password Confirmation</label>
                    <input class="md-input" type="password" id="login_password" name="password_confirmation"/>
                    @include('layouts.partials.form-errors', ['field'=>'password_confirmation'])
                    <div class="uk-margin-medium-top">
                        <button type="submit"
                                class="md-btn md-btn-primary md-btn-block md-btn-large">Reset Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
    @yield('d-scripts')
@endsection
