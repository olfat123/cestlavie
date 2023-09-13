@extends('layouts.admin.app')
@section('title',__('auth.login'))
@section('styles')
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <link type="text/css" href="{{ asset('assets/admin/css/login.css')}}" rel="stylesheet"/>
    @yield('d-styles')
@endsection
@section('content')
@section('body_class','login_page')
<div class="login_page_wrapper">
    <div class="md-card" id="login_card">
        <div class="md-card-content large-padding" id="login_form">
            <div class="login_heading">
                <div class="user_avatar"></div>
            </div>
            <form class="ajax" id="login" method="POST"
                  action="{{ route('login.store') }}">
                @csrf
                <div class="uk-form-row">
                    <label for="login_username">@lang('auth.email')</label>
                    <input class="md-input" type="text" id="login_username" name="email"/>
                    @include('layouts.partials.form-errors',['field'=>"email"])
                </div>
                <div class="uk-form-row">
                    <label for="login_password">@lang('auth.password')</label>
                    <input class="md-input" type="password" id="login_password" name="password"/>
                    @include('layouts.partials.form-errors',['field'=>"password"])
                </div>
                <div class="uk-margin-medium-top">
                    <button type="submit"
                            class="md-btn md-btn-primary md-btn-block md-btn-large">@lang('auth.login')</button>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-margin-top uk-text-center">
        <a href="{{route('password.request')}}" id="signup_form_show">@lang('auth.forgot_password?')</a>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
    {{--    <script src="{{asset('assets/admin/js/login.js')}}"></script>--}}
    @yield('d-scripts')
@endsection
