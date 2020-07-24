@if(hasPermission($indexUrl.'/'.$item->id, 'delete'))
  <button type="button" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#confirmDeleteModal"
          data-href="{{ $indexUrl }}/{{ $item->id }}">
    {{ translate('Delete') }}
  </button>
@endif