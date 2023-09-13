@extends('layouts.admin.app')
@section('title',__('auth.login'))
@section('styles')
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <link type="text/css" href="{{ asset('assets/admin/css/login.css')}}" rel="stylesheet"/>
    @yield('d-styles')
@endsection
@section('content')
@section('body_class','login_page')
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card" id="signInForm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
                                <h1 class="register-title">@lang('auth.login')</h1>
                                @include('auth._partials.social-login')
                            </div>
                            <div class="col-12 col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">
                                <form class="ajax" id="login" method="POST"
                                      action="{{ route('login.store') }}">
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-12 mt-3">
                                            <div class="form-float-label-group">
                                                <input class="form-control form-float-control" id="formInput_loginEmail"
                                                       name="email" type="email" placeholder="@lang('auth.email')"
                                                       required>
                                                @include('layouts.partials.form-errors', ['field'=>'email'])
                                                <label for="formInput_loginEmail">@lang('auth.email')</label>
                                            </div>

                                            <div class="form-float-label-group">
                                                <input class="form-control form-float-control"
                                                       id="formInput_loginPassword" name="password" type="password"
                                                       placeholder="@lang('auth.password')" required>
                                                @include('layouts.partials.form-errors', ['field'=>'password'])
                                                <label for="formInput_loginPassword">@lang('auth.password')</label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3 txt-align-center"><a
                                                class="btn btn-link text-main-color btn-sm text-capitalize"
                                                href="{{route('password.request')}}">@lang('auth.forgot_password?')</a>
                                        </div>
                                        <div class="col-12 my-3">
                                            <button class="btn btn-danger btn-block" type="submit">@lang('auth.login')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
