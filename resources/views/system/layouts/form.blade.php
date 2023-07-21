{{-- <!DOCTYPE html>
<html lang="en">

@include('system.layouts.layoutHeader')
<body>
    @include('system.partials.header')
    <div class="page-wrapper">
        @include('system.partials.sidebar')
        <div class="page-contents clearfix">
            <div class="inner-content-fluid">
                <div class="custom-container-fluid">
                    @section('breadcrumb')
                    @include('system.partials.breadcrumb')
                    @show
                    <div class="page-head clearfix">
                        <div class="row">
                            <div class="col-9">
                                <div class="head-title">
                                    <h4>{{ translate($title) }}</h4>
                                </div><!-- ends head-title -->
                            </div>
                        </div>
                    </div><!-- ends page-head -->

                    <div class="content-display clearfix custom-border">
                        <div class="panel panel-default custom-padding">
                            <div class="panel-body">
                                @include('system.partials.message')
                                <form method="post" action="{{isset($item) ? url($indexUrl.'/'.$item->id) : url($indexUrl)}}" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($item))
                                    @method('PUT')
                                    @endif
                                    @yield('inputs')
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ !isset($item) ? translate('Create') : translate('Update')}}
                                            </button>
                                            <a href="{{url($indexUrl)}}" class="btn btn-secondary">
                                                <em class="far fa-window-close"></em> {{ translate('Cancel') }}
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
    @include('system.layouts.editorScript')
    @yield('scripts')
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">
@include('system.layouts.layoutHeader')

<body>
    <!-- Loader starts-->
    @include('system.partials.loader')
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('system.partials.header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('system.partials.sidebar')
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3>{{ $title ?? '' }}</h3>
                            </div>
                            <div class="col-12 col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"> <a class="home-item" href="index.html"><i
                                                data-feather="home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"> Dashboard</li>
                                    <li class="breadcrumb-item active"> {{ $title ?? '' }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @section('create')
                @show
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <br />
                            <div class="card-header pb-0 mb-4">
                                <div class="content-display clearfix custom-border">
                                    <div class="panel panel-default custom-padding">
                                        <div class="panel-body">
                                            @include('system.partials.message')
                                            <form method="post"
                                                action="{{ isset($item) ? url($indexUrl . '/' . $item->id) : url($indexUrl) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @if (isset($item))
                                                    @method('PUT')
                                                @endif
                                                @yield('inputs')
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            {{ !isset($item) ? translate('Create') : translate('Update') }}
                                                        </button>
                                                        <a href="{{ url($indexUrl) }}" class="btn btn-secondary">
                                                            <em class="fa fa-window-close"></em>
                                                            {{ translate('Cancel') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- panel -->
                                </div><!-- ends content-display -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- ends content-display -->

        </div>

        <!-- Page Sidebar Ends-->

        <!-- footer start-->
        @include('system.layouts.layoutFooter')
        @include('system.layouts.editorScript')
        @yield('scripts')

    </div>
    </div>
</body>

</html>
