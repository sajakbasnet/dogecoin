<!DOCTYPE html>
<html lang="en">

<head>
    @include('system.layouts.layoutHeader')
</head>

<body>

    @include('system.partials.header')
    <div class="page-wrapper">
        @include('system.partials.sidebar')
        <div class="page-contents clearfix">
            <div class="inner-content-fluid">
                <div class="custom-container-fluid">

                    @include('system.partials.breadcrumb')

                    <div class="page-head clearfix">
                        <div class="row">
                            <div class="col-9">
                                <div class="head-title">
                                    <h4>{{ $title }}</h4>
                                </div><!-- ends head-title -->
                            </div>
                        </div>
                    </div><!-- ends page-head -->

                    <div class="content-display clearfix">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @include('system.partials.message')
                                <form method="post" action="{{ $indexUrl }}{{isset($items['item']) ? '/'.$items['item']->id : ''}}" enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($items['item']))
                                    @method('PUT')
                                    @endif
                                    @yield('inputs')
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">
                                                {{ !isset($items['item']) ? trans('Create') : trans('Update')}}
                                            </button>
                                            <a href="{{ $indexUrl }}" class="btn btn-secondary">
                                                {{ trans('Cancel') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- panel -->
                    </div><!-- ends content-display -->
                </div>
            </div><!-- ends custom-container-fluid -->
        </div><!-- ends page-contents -->
    </div><!-- page-wrapper -->

    @include('system.layouts.layoutFooter')
    @yield('scripts')
</body>

</html>