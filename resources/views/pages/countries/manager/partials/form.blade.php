@csrf
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-large-7-10">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    @if(isset($country))
                        Edit Country
                    @else
                        Add New Country
                    @endif
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1" >
                        <label for="coupon_title">Country Name </label>
                        <input class="md-input"
                                type="text"
                                @isset($country) value="{{isset($country)? $country->country :''}}"
                                @endisset
                                id="coupon_title"
                                name="country"/>
                        @include("layouts.partials.form-errors",['field'=>"country"])
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
        @if(isset($country))
            {{-- @can('delete_coupons') --}}
            <button
                data-uk-modal="{target:'#confirmationModal'}"
                data-action="{{route('country.manager.destroy',$country->id)}}"
                data-append-input="1"
                data-field_name="redirect_to"
                data-field_value="{{ url()->previous() }}"
                data-custom_method='@method('DELETE')'
                class="confirm-action-button md-btn md-btn-danger md-btn-block md-btn-large md-btn-wave-light waves-effect waves-button waves-light mt-20">
                Delete Country
            </button>
            {{-- @endcan --}}
        @endif
    </div>
</div>