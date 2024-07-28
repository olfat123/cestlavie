<tr>
    <td>{{$country->country}}</td>
    <td>{{$country->country == 'All Countries'? $tokens_count:sizeOf($country->tokens)}}</td>
    <td>{{$country->count_android()?:0}}</td>
    <td>{{$country->count_ios()?:0}}</td>
    {{-- <td>
        @can('edit_coupons')
        <a href="{{route('country.manager.edit',$country->id)}}"><i class="md-icon material-icons">&#xE254;</i></a>
        @endcan

        @can('delete_coupons')
        <a class="confirm-action-button"
           data-uk-modal="{target:'#confirmationModal'}"
           data-action="{{route('country.manager.destroy',$country->id)}}"
           data-custom_method='@method('DELETE')'
        ><i class="md-icon material-icons">delete</i></a>
        @endcan
    </td> --}}
</tr>
