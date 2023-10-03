@extends('layouts.admin.dashboard')
@section('title','Add New Country')

@section('d-content')
    <form action="{{route('country.manager.store')}}" method="POST" class="ajax" id="couponStore"
          enctype="multipart/form-data">
        @include('pages.countries.manager.partials.form',['submit_button'=>'Create'])
    </form>
@endsection
@section('d-scripts')
    <script src="{{asset('assets/admin/js/wysiwyg.js')}}"></script>
    <script src="{{asset('assets/admin/js/uikit_fileinput.js')}}"></script>
@endsection