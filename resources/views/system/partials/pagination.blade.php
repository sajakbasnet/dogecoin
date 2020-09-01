@if(!$items->isEmpty())
    <div class="pagination-tile">
        <label class="pagination-sub" style="display: block">
        {{translate('Showing') }} {{($items->currentpage()-1)*$items->perpage()+1}} {{translate('to')}} {{(($items->currentpage()-1)*$items->perpage())+$items->count()}} {{translate('of')}} {{$items->total()}} {{translate('entries')}}
            <!-- {{translate('showing to of entries', ['from' => ($items->currentpage()-1)*$items->perpage()+1, 'to' => (($items->currentpage()-1)*$items->perpage())+$items->count(), 'total' => $items->total()])}} -->
        </label>
        <ul class="pagination">
            {!! str_replace('/?', '?',$items->appends(['keyword'=>Request::get('keyword'), 'group'=>Request::get('group'), 'locale'=>Request::get('locale'),'from'=>Request::get('from'), 'to'=>Request::get('to'), 'role' => Request::get('role')])->render()) !!}
        </ul>
    </div>
    @endif