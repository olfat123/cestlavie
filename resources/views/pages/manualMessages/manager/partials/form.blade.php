@csrf
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-large-7-10">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    @if(isset($message))
                        Edit Message
                    @else
                        Add New Message
                    @endif
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1" >
                        <label for="coupon_title">Title </label>
                        <input class="md-input"
                                type="text"
                                @isset($message) value="{{isset($message)? $message->title :''}}"
                                @endisset
                                id="coupon_title"
                                name="title"/>
                        @include("layouts.partials.form-errors",['field'=>"title"])
                    </div>
                    <div class="uk-width-medium-1-1">
                        <label for="country" class="uk-form-label">
                            Country
                        </label>
                        <select id="country" name="country_id" data-md-selectize data-md-selectize-bottom class="text-capitalize">
                            {{-- <option class="text-capitalize" value="0">All Countries</option> --}}
                            @foreach($countries as $country)
                                <option class="text-capitalize" data-id="{{$country->id}}"
                                        @if(isset($message) && $message->country_id == $country->id) selected
                                        @endif
                                        value="{{$country->id}}">{{$country->country}}</option>
                            @endforeach
                        </select>
                        @include("layouts.partials.form-errors",['field'=>'country_id'])
                    </div>
                </div>
                
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1" >
                        <div class="md-input-wrapper md-input-filled">
                            <label>Body </label>
                            <textarea cols="30" rows="4" class="md-input" style="height: 192px; width: 568px;" name="message">@isset($message) {{$message->message}} @endisset</textarea>
                            <span class="md-input-bar "></span>
                            @include("layouts.partials.form-errors",['field'=>"message"])
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
        
        @if(isset($message))
            {{-- @can('delete_coupons') --}}
            <button
                data-uk-modal="{target:'#confirmationModal'}"
                data-action="{{route('manualMessage.manager.destroy',$message->id)}}"
                data-append-input="1"
                data-field_name="redirect_to"
                data-field_value="{{ url()->previous() }}"
                data-custom_method='@method('DELETE')'
                class="confirm-action-button md-btn md-btn-danger md-btn-block md-btn-large md-btn-wave-light waves-effect waves-button waves-light mt-20">
                Delete Message
            </button>
            {{-- @endcan --}}
        @endif
    </div>
</div>
