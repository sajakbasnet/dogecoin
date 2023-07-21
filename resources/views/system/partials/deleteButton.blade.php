@if(hasPermission($indexUrl.'/'.$item->id, 'delete'))
  <button type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#confirmDeleteModal"
          data-href="{{url($indexUrl.'/'.$item->id)}}">
          <em class="fa fa-trash"></em> {{ translate('Delete') }}
  </button>
@endif
