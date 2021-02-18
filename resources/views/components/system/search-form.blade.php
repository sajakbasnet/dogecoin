@props(['action', 'method'])
<form method="{{ $method ?? 'get' }}" action="{{$action}}" class="mb-2">
    <div class="form-row align-items-center">
        {{$inputs}}
        <div class="form-row align-items-center">
        <button class="btn btn-primary mb-2 ml-2" type="submit"><em class="fas fa-search"></em> {{translate('Search')}}</button>
        </div>
    </div>
</form>