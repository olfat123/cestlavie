@extends('layouts.admin.dashboard')
@section('title','Edit Verse')

@section('d-content')
    <form action="{{route('wVerse.manager.update',$wVerse->id)}}" method="POST" class="ajax" id="couponUpdate"
          enctype="multipart/form-data">
        @method('PATCH')
        <input type="hidden" name="redirect_to" value="{{url()->previous()}}">
        @include('pages.wverses.manager.partials.form',['submit_button'=>'Update'])
    </form>
@endsection
@section('d-scripts')
    <script src="{{asset('assets/admin/js/wysiwyg.js')}}"></script>
    <script src="{{asset('assets/admin/js/uikit_fileinput.js')}}"></script>
@endsection
