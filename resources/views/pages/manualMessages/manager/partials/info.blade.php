<tr>
    <td>{{$message->title}}</td>
    <td>
        {{-- @can('edit_coupons') --}}
        <a href="{{route('manualMessage.manager.edit',$message->id)}}"><i class="md-icon material-icons">&#xE254;</i></a>
        {{-- @endcan --}}

        {{-- @can('delete_coupons') --}}
        <a class="confirm-action-button"
           data-uk-modal="{target:'#confirmationModal'}"
           data-action="{{route('manualMessage.manager.destroy',$message->id)}}"
           data-custom_method='@method('DELETE')'
        ><i class="md-icon material-icons">delete</i></a>
        {{-- @endcan --}}
    </td>
</tr>
