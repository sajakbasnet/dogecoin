<!DOCTYPE html>
<html lang="en">

@include('system.layouts.layoutHeader')

<body class="main-body app sidebar-mini">

    <div id="global-loader" class="light-loader">
        <img src="{{ asset('fonts/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <div class="page">
        @include('system.partials.sidebar')
        <div class="main-content app-content">
            @include('system.partials.header')
            <div class="container-fluid">
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <!-- <p class="text-muted mb-0 hover-cursor"> / Cadastro / Pessoa Física</p> -->
                            @include('system.partials.breadcrumb')
                        </div>
                    </div>
                </div>

                <div class="page-contents clearfix">
                    <div class="inner-content-fluid">
                        <div class="custom-container-fluid">

                            @section('title')

                            <div class="row">
                                <div class="col-6">
                                    <div class="head-title">
                                        <h4>{{ $title }}</h4>
                                    </div><!-- ends head-title -->
                                </div>

                                @if(hasPermission($indexUrl.'/create', 'get'))
                                @section('create')
                                <div class="col-6">
                                    <a class="btn btn-primary btn-sm" style="float:right;" id="addNew" href="{{url($indexUrl.'/create')}}">
                                        <em class="fa fa-plus"></em> {{'Add New'}}
                                    </a>
                                </div>
                                @show
                                @endif
                            </div>

                            @show
                            <div class="content-display clearfix">
                                @yield('header')

                                <div class="panel">
                                    <div class="panel-box">
                                        @include('system.partials.message')
                                        <div class="table-responsive mt-3">
                                            <table class="table table-striped table-bordered" aria-describedby="general table">
                                                <thead>
                                                    @yield('table-heading')
                                                </thead>
                                                <tbody>
                                                    @if($items->isEmpty())
                                                    <tr>
                                                        <td colspan="100%" class="text-center">{{'No data available'}}</td>
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
                </div>
            </div>
        </div>
        <div class="main-footer ht-40">
            <div class="container-fluid pd-t-0-f ht-100p">
                <span>Copyright © 2023 <a href="#">Doge Caramelo Coin</a>. Todos os direitos reservados.</span>
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">{{'Confirm Delete'}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            <em class="glyph-icon icon-close"></em> Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger" id="confirmDelete">
                            <em class="glyph-icon icon-trash"></em> Delete
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