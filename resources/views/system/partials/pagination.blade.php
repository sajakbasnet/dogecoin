@if(!$items->isEmpty())
    <div class="pagination-tile">
        <label class="pagination-sub" style="display: block">
            {{translate('Showing') }} {{($items->currentpage()-1)*$items->perpage()+1}} {{translate('to')}} {{(($items->currentpage()-1)*$items->perpage())+$items->count()}} {{translate('of')}} {{$items->total()}} {{translate('entries')}}
        </label>
        <ul class="pagination">
            {!! str_replace('/?', '?',$items->appends(['keywords'=>Request::get('keywords')])->render()) !!}
        </ul>
    </div>
    @endif