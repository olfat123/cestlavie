@extends('layouts.admin.dashboard')
@section('title','Countries')
@section('d-buttons')
    {{-- @can('add_coupons') --}}
    {{-- <a href="{{route('country.manager.create')}}"
       class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light uk-float-right">
        Add New Country
    </a> --}}
    {{-- @endcan --}}
@endsection
@section('d-content')
    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <form action="{{route('country.manager.index')}}">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <label for="contact_list_search">Search...</label>
                        <input class="md-input" name="q" value="{{request('q')}}" type="text" id="contact_list_search"/>
                    </div>
                </div>
                <div class="uk-text-right mt-20">
                    <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button"
                       href="{{route('country.manager.index')}}">Reset Filters</a>
                    <button type="submit"
                            class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">
                        Filter Results
                    </button>

                </div>
            </form>
        </div>
    </div>
    @if (!$countries->count())
        @include('pages._partials.no-listing-data')
    @else
        <h3 class="uk-text-large ml-20">({{$countries->total()}}) Countries</h3>
        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="uk-overflow-container">
                    <table class="uk-table uk-table-nowrap">
                        <thead>
                        <tr>
                            <th>Country Name</th>
                            <th>Count</th>
                            <th>Android</th>
                            <th>IOS</th>
                            {{-- <th class="uk-width-3-10 uk-text-center">Actions</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($countries as $country)
                            @include('pages.countries.manager.partials.info')
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @include('layouts.admin.partials.pagination',['collection'=>$countries])
    @endif
@endsection
