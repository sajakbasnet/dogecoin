@if(!$items['items']->isEmpty())
    <div class="pagination-tile">
        <label class="pagination-sub" style="display: block">
            {{trans('Showing') }} {{($items['items']->currentpage()-1)*$items['items']->perpage()+1}} {{trans('to')}} {{(($items['items']->currentpage()-1)*$items['items']->perpage())+$items['items']->count()}} {{trans('of')}} {{$items['items']->total()}} {{trans('entries')}}
        </label>
        <ul class="pagination">
            {!! str_replace('/?', '?',$items['items']->appends(['keywords'=>Request::get('keywords')])->render()) !!}
        </ul>
    </div>
    @endif