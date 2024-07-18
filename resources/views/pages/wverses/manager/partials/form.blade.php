@csrf
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-large-7-10">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    @if(isset($wVerse))
                        Edit Verse
                    @else
                        Add New Verse
                    @endif
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2" >
                        <label for="coupon_title">Title </label>
                        <input class="md-input"
                                type="text"
                                @isset($wVerse) value="آية اليوم"
                                @endisset
                                id="coupon_title"
                                name="title" disabled/> 
                        @include("layouts.partials.form-errors",['field'=>"title"])
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="country" class="uk-form-label">
                            Country
                        </label>
                        <select id="country" name="country_id" data-md-selectize data-md-selectize-bottom class="text-capitalize">
                            {{-- <option class="text-capitalize" value="0">All Countries</option> --}}
                            @foreach($countries as $country)
                                <option class="text-capitalize" data-id="{{$country->id}}"
                                        @if(isset($wVerse) && $wVerse->country_id == $country->id) selected
                                        @endif
                                        value="{{$country->id}}">{{$country->country}}</option>
                            @endforeach
                        </select>
                        @include("layouts.partials.form-errors",['field'=>'country_id'])
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="day" class="uk-form-label">
                            Day to send
                        </label>
                        <select id="day" name="day_to_send" data-md-selectize data-md-selectize-bottom class="text-capitalize">
                            <option class="text-capitalize" value="0">All Days</option>
                            @foreach($days as $day)
                                <option class="text-capitalize" data-id="{{$day}}"
                                        @if(isset($wVerse) && $wVerse->day_to_send == $day) selected
                                        @endif
                                        value="{{$day}}">{{$day}}</option>
                            @endforeach
                        </select>
                        @include("layouts.partials.form-errors",['field'=>'day_to_send'])
                    </div>
                    <div class="uk-width-medium-1-2">
                        <label for="hour" class="uk-form-label">
                            Hour to send
                        </label>
                        <select id="hour" name="hour_to_send" data-md-selectize data-md-selectize-bottom class="text-capitalize">
                            <option class="text-capitalize" value="0">All Hours</option>
                            @foreach($hours as $hour)
                                <option class="text-capitalize" data-id="{{$hour}}"
                                        @if(isset($wVerse) && $wVerse->hour_to_send == $hour) selected
                                        @endif
                                        value="{{$hour}}">{{$hour}}</option>
                            @endforeach
                        </select>
                        @include("layouts.partials.form-errors",['field'=>'hour_to_send'])
                    </div>
                    @isset($wVerse)
                        <div class="uk-width-medium-1-2" >
                            <label for="order">Order </label>
                            <input class="md-input"
                                    type="text"
                                    @isset($wVerse) value="{{isset($wVerse)? $wVerse->order :''}}"
                                    @endisset
                                    id="order"
                                    name="order"/>
                            @include("layouts.partials.form-errors",['field'=>"order"])
                        </div>
                    @endisset
                    
                    <div class="uk-width-medium-1-1" >
                        <div class="uk-form-row">
                            <div class="md-input-wrapper md-input-filled">
                                <label>Body </label>
                                <textarea cols="30" rows="4" class="md-input" style="height: 192px; width: 568px;" name="verse">@isset($wVerse) {{$wVerse->verse}} @endisset</textarea>
                                <span class="md-input-bar "></span>
                                @include("layouts.partials.form-errors",['field'=>"verse"])
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
            
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-2-3">
                <button
                    class="md-btn md-btn-primary md-btn-block md-btn-large md-btn-wave-light waves-effect waves-button waves-light"
                    type="submit">
                    {{$submit_button}}
                </button>
            </div>
            <div class="uk-width-medium-1-3">
                <a href="{{url()->previous()}}"
                   class="md-btn md-btn-block md-btn-large md-btn-wave-light waves-effect waves-button waves-light">
                    Cancel
                </a>
            </div>
        </div>
       
    </div>
    <div class="uk-width-large-3-10">        
        @if(isset($wVerse))
            {{-- @can('delete_coupons') --}}
            <button
                data-uk-modal="{target:'#confirmationModal'}"
                data-action="{{route('wVerse.manager.destroy',$wVerse->id)}}"
                data-append-input="1"
                data-field_name="redirect_to"
                data-field_value="{{ url()->previous() }}"
                data-custom_method='@method('DELETE')'
                class="confirm-action-button md-btn md-btn-danger md-btn-block md-btn-large md-btn-wave-light waves-effect waves-button waves-light mt-20">
                Delete Verse
            </button>
            {{-- @endcan --}}
        @endif
    </div>
</div>