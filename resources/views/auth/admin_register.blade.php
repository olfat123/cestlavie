@extends('layouts.admin.app')
@section('title',__('auth.register'))
@section('styles')
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    {{-- <link type="text/css" href="{{ asset('assets/admin/css/login.css')}}" rel="stylesheet"/> --}}
    <link type="text/css" href="{{ asset('assets/admin/css/main.css') }}" rel="stylesheet"/>

    @yield('d-styles')
@endsection
@section('content')
@section('body_class','login_page')
    <div style="width: 650px;max-width: 100%;margin: 0 auto;">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="register_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>
                <form class="ajax" id="register" method="POST"
                    action="{{ route('register.store') }}">
                    @csrf
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2" >
                            <label for="vendor_title">Name</label>
                            <input class="md-input"
                                type="text" value=""
                                id="vendor_title"
                                name="name"/>
                            @include("layouts.partials.form-errors",['field'=>"name"])
                        </div>
                        <div class="uk-width-medium-1-2" >
                            <label for="vendor_title">Email</label>
                            <input class="md-input"
                                type="text" value=""
                                id="vendor_title"
                                name="email"/>
                            @include("layouts.partials.form-errors",['field'=>"email"])
                        </div>
                        <div class="uk-width-medium-1-2" >
                            <label for="mobile">Mobile</label>
                            <input class="md-input"
                                type="number" value=""
                                id="mobile"
                                name="mobile"/>
                            @include("layouts.partials.form-errors",['field'=>"mobile"])
                        </div>
                        <div class="uk-width-medium-1-2" >
                            <label for="bank_name">Bank name</label>
                            <input class="md-input"
                                type="text" value=""
                                id="bank_name"
                                name="bank_name"/>
                            @include("layouts.partials.form-errors",['field'=>"bank_name"])
                        </div>
                        <div class="uk-width-medium-1-2" >
                            <label for="bank_account_name">Bank account name</label>
                            <input class="md-input"
                                type="text" value=""
                                id="bank_account_name"
                                name="bank_account_name"/>
                            @include("layouts.partials.form-errors",['field'=>"bank_account_name"])
                        </div>

                        <div class="uk-width-medium-1-2" >
                            <label for="branch_name">Branch name</label>
                            <input class="md-input"
                                type="text" value=""
                                id="branch_name"
                                name="branch_name"/>
                            @include("layouts.partials.form-errors",['field'=>"branch_name"])
                        </div>

                        <div class="uk-width-medium-1-2" >
                            <label for="iban">iban</label>
                            <input class="md-input"
                                type="text" value=""
                                id="iban"
                                name="iban"/>
                            @include("layouts.partials.form-errors",['field'=>"iban"])
                        </div>

                        <div class="uk-width-medium-1-2" >
                            <label for="bank_account_number">Bank account number</label>
                            <input class="md-input"
                                type="text" value=""
                                id="bank_account_number"
                                name="bank_account_number"/>
                            @include("layouts.partials.form-errors",['field'=>"bank_account_number"])
                        </div>
                        @php
                            $has_category = isset($vendor) && $vendor->category;
                        @endphp
                        <div class="uk-form-row">
                            <label class="uk-form-label">
                                Host Category
                            </label>
                            <div class="categories-text" style="margin: 5px auto;">
                            
                            </div>
                            <div class="uk-margin-top uk-margin-bottom">
                                <button
                                    data-uk-modal="{target:'#categoryTreeModal'}"
                                    type="button" class="md-btn md-btn-primary">
                                        Select Category
                                </button>
                            </div>
                            @include('pages.vendors.manager.partials.category-select',['categories_holder'=>$has_category?$vendor:null])

                            @include("layouts.partials.form-errors",['field'=>'categories'])
                        </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <label for="user_edit_password_control">Password</label>
                        <input class="md-input" type="password"
                            id="user_edit_password_control"
                            name="password"/>
                        @include('layouts.partials.form-errors',['field'=>"password"])
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="user_edit_password_confirmation_control">Password
                            Confirmation</label>
                        <input class="md-input" type="password"
                            id="user_edit_password_confirmation_control"
                            name="password_confirmation"/>
                        @include('layouts.partials.form-errors',['field'=>"password_confirmation"])
                    </div>
                    
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <label for="brand_image">Cover</label>
                        <input type="file" id="brand_image" name="cover" class="dropify"
                                data-max-file-size="2M" />
                        @include("layouts.partials.form-errors",['field'=>"cover"])
                    </div>
                    <div class="uk-width-medium-1-1">
                        <label for="brand_image">Logo</label>
                        <input type="file" id="brand_image" name="logo" class="dropify"
                                data-max-file-size="2M" />
                        @include("layouts.partials.form-errors",['field'=>"logo"])
                    </div>
                    <div class="uk-width-medium-1-1" >
                        <label for="page_content">Bio </label>
                        <textarea cols="30" rows="2" name="bio" class="md-input no_autosize"></textarea>
                        @include("layouts.partials.form-errors",['field'=>"bio"])
                    </div>
                </div>
                    <div class="uk-margin-medium-top">
                        <button type="submit"
                                class="md-btn md-btn-primary md-btn-block md-btn-large">@lang('auth.register')</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="uk-margin-top uk-text-center">
            <a href="{{route('admin.login')}}" id="signup_form_show">@lang('auth.login?')</a>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
    {{--    <script src="{{asset('assets/admin/js/login.js')}}"></script>--}}
    <script src="{{asset('assets/admin/js/wysiwyg.js')}}"></script>
    <script src="{{asset('assets/admin/js/tree-select.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".tree-select").treeMultiselect({
                collapsible: true,
                hideSidePanel: true,
                // maxSelections: 1,
                sectionDelimiter: '/',
                startCollapsed: true,
                searchable: true,
                onChange: function () {
                    var selectedOptions = $(".tree-select").val();
                    var elements = [];
                    for (var i = 0; i < selectedOptions.length; i++) {
                        var value = selectedOptions[i];
                        var text = $('.tree-select option[value="' + value + '"]').text();
                        var element = "<div class='category-value'>" + text + "</div>";
                        elements.push(element);
                    }
                    $('.categories-text').html(elements);
                    getAttributes(selectedOptions);
                }
            });
        })
        ;
    @yield('d-scripts')
@endsection
