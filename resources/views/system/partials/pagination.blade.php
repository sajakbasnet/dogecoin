@if(!$items->isEmpty())
    <div class="pagination-tile">
        <label class="pagination-sub" style="display: block">
            {{trans('Showing') }} {{($items->currentpage()-1)*$items->perpage()+1}} {{trans('to')}} {{(($items->currentpage()-1)*$items->perpage())+$items->count()}} {{trans('of')}} {{$items->total()}} {{trans('entries')}}
        </label>
        <ul class="pagination">
            {!! str_replace('/?', '?',$items->appends(['keywords'=>Request::get('keywords')])->render()) !!}
        </ul>
    </div>
    @endif