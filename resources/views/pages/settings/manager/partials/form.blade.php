@csrf
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-large-7-10">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    @if(isset($setting))
                        Edit Message
                    @else
                        Add New Message
                    @endif
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2" >
                        <label for="coupon_title">Title </label>
                        <input class="md-input" 
                                type="text"
                                @isset($setting) value="{{isset($setting)? $setting->key :''}}" disabled
                                @endisset
                                id="coupon_title"
                                name="key"/>
                        @include("layouts.partials.form-errors",['field'=>"key"])
                    </div>
                    
                    
                    <div class="uk-width-medium-1-1" >
                        <div class="uk-form-row">
                            <div class="md-input-wrapper md-input-filled">
                                <label>Value </label>
                                <textarea cols="30" rows="4" class="md-input" style="height: 192px; width: 568px;" name="value">@isset($setting) {{$setting->value}} @endisset</textarea>
                                <span class="md-input-bar "></span>
                                @include("layouts.partials.form-errors",['field'=>"value"])
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-1">
                        <label for="brand_image">Image</label>
                        <input type="file" id="brand_image" name="cover" class="dropify"
                               data-max-file-size="2M"
                               @if(isset($setting) && $setting->cover) data-default-file="{{$setting->cover}}" @endif/>
                        @include("layouts.partials.form-errors",['field'=>"cover"])
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
    {{-- <div class="uk-width-large-3-10">        
        @if(isset($wMessage))
            <button
                data-uk-modal="{target:'#confirmationModal'}"
                data-action="{{route('wMessage.manager.destroy',$wMessage->id)}}"
                data-append-input="1"
                data-field_name="redirect_to"
                data-field_value="{{ url()->previous() }}"
                data-custom_method='@method('DELETE')'
                class="confirm-action-button md-btn md-btn-danger md-btn-block md-btn-large md-btn-wave-light waves-effect waves-button waves-light mt-20">
                Delete Message
            </button>
        @endif
    </div> --}}
</div>