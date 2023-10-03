<tr>
    <td>{{$wVerse->verse}}</td>
    <td>{{$wVerse->country->country}}</td>
    <td>
        {{-- @can('edit_coupons') --}}
        <a href="{{route('wVerse.manager.edit',$wVerse->id)}}"><i class="md-icon material-icons">&#xE254;</i></a>
        {{-- @endcan --}}

        {{-- @can('delete_coupons') --}}
        <a class="confirm-action-button"
           data-uk-modal="{target:'#confirmationModal'}"
           data-action="{{route('wVerse.manager.destroy',$wVerse->id)}}"
           data-custom_method='@method('DELETE')'
        ><i class="md-icon material-icons">delete</i></a>
        {{-- @endcan --}}
    </td>
</tr>
