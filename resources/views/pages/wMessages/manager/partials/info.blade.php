<tr>
    <td>{{$wMessage->title}}</td>
    <td>{{$wMessage->country->country}}</td>
    <td>
        {{-- @can('edit_coupons') --}}
        <a href="{{route('wMessage.manager.edit',$wMessage->id)}}"><i class="md-icon material-icons">&#xE254;</i></a>
        {{-- @endcan --}}

        {{-- @can('delete_coupons') --}}
        <a class="confirm-action-button"
           data-uk-modal="{target:'#confirmationModal'}"
           data-action="{{route('wMessage.manager.destroy',$wMessage->id)}}"
           data-custom_method='@method('DELETE')'
        ><i class="md-icon material-icons">delete</i></a>
        {{-- @endcan --}}
    </td>
</tr>
