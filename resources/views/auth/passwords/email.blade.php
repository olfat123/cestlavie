@extends('layouts.admin.app')
@section('title','Forget Password')
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
                <h3>Forget Password</h3>
            </div>
            <form class="ajax"
                  id="forgot"
                  method="POST"
                  action="{{route('password.email')}}">
                @csrf
                <div class="uk-form-row">
                    <label for="login_username">@lang('auth.email')</label>
                    <input class="md-input" type="text" id="login_username" name="email"/>
                    @include('layouts.partials.form-errors', ['field'=>'email'])
                    <div class="uk-margin-medium-top">
                        <button type="submit"
                                class="md-btn md-btn-primary md-btn-block md-btn-large">Send Reset Link
                        </button>
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
