@extends('layouts.admin.app')
@section('styles')
    <link type="text/css" href="{{ asset('assets/admin/css/main.css') }}" rel="stylesheet"/>
    @yield('d-styles')
@endsection
@section('content')
@section('body_class','disable_transitions sidebar_main_open sidebar_main_swipe')
<!-- main header -->
@include('layouts.admin.partials.nav')
@include('layouts.admin.partials.sidebar')
@include('layouts.partials.confirmation')
<div id="page_content">
    @include('layouts.admin.partials.breadcrumb')
    <div id="page_content_inner">
        @yield('d-content')
    </div>
</div>
{{-- @include('layouts.admin.partials.footer') --}}
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/js/main.js')}}"></script>
    @if(isset($active_status) && isset($inactive_status))
        <script>
            $("input#status").on('change', function () {
                if ($(this).prop("checked") === true) {
                    $("input[type='hidden'][name='status_id']").val({{$active_status}});
                } else {
                    $("input[type='hidden'][name='status_id']").val({{$inactive_status}});
                }
            })
        </script>
    @endif
    @yield('d-scripts')
@endsection
