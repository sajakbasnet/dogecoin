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
                    @section('title')
                    <div class="page-head clearfix">
                        <div class="row">
                            <div class="col-6">
                                <div class="head-title">
                                    <h4>{{ $title }}</h4>
                                </div><!-- ends head-title -->
                            </div>
                            <div class="col-6">
                                @if(\ekHelper::hasPermission($indexUrl.'/create'))
                                <a class="btn btn-primary pull-right btn-sm" id="addNew" href="{{$indexUrl}}/create">
                                    <i class="fa fa-plus"></i> {{trans('Add New')}}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div><!-- ends page-head -->
                    @show
                    <div class="content-display clearfix">
                        @yield('header')
                        <div class="panel">
                            <div class="panel-box">
                                @include('system.partials.message')
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped">
                                        <thead>
                                            @yield('table-heading')
                                        </thead>
                                        <tbody>
                                            @if($items['items']->isEmpty())
                                            <tr>
                                                <td colspan="100%" class="text-center">No data available</td>
                                            </tr>
                                            @else
                                            @yield('table-data')
                                            @endif
                                        </tbody>
                                    </table>
                                    @include('system.partials.pagination')
                                </div>
                            </div>
                        </div><!-- panel -->
                    </div><!-- ends content-display -->
                </div>
            </div><!-- ends custom-container-fluid -->
        </div><!-- ends page-contents -->
    </div><!-- page-wrapper -->

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">{{trans('Confirm Delete')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{trans('Are you sure you want to delete?')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            <i class="glyph-icon icon-close"></i> {{trans('Cancel')}}
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger" id="confirmDelete">
                            <i class="glyph-icon icon-trash"></i> {{trans('Delete')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('system.layouts.layoutFooter')
    @yield('scripts')
</body>

</html>