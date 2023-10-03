@extends('layouts.admin.dashboard')
@section('title','Edit Country')

@section('d-content')
    <form action="{{route('country.manager.update',$country->id)}}" method="POST" class="ajax" id="couponUpdate"
          enctype="multipart/form-data">
        @method('PATCH')
        <input type="hidden" name="redirect_to" value="{{url()->previous()}}">
        @include('pages.countries.manager.partials.form',['submit_button'=>'Update'])
    </form>
@endsection
@section('d-scripts')
    <script src="{{asset('assets/admin/js/wysiwyg.js')}}"></script>
    <script src="{{asset('assets/admin/js/uikit_fileinput.js')}}"></script>
@endsection
