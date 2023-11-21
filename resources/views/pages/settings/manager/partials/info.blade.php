<tr>
    <td>{{$setting->key}}</td>
    <td>{{$setting->value}}</td>
    <td>
        {{-- @can('edit_coupons') --}}
        <a href="{{route('setting.manager.edit',$setting->id)}}"><i class="md-icon material-icons">&#xE254;</i></a>
        {{-- @endcan --}}

        {{-- @can('delete_coupons') --}}
        {{-- <a class="confirm-action-button"
           data-uk-modal="{target:'#confirmationModal'}"
           data-action="{{route('setting.manager.destroy',$setting->id)}}"
           data-custom_method='@method('DELETE')'
        ><i class="md-icon material-icons">delete</i></a> --}}
        {{-- @endcan --}}
    </td>
</tr>
