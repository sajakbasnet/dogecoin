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
                            </div>

                            @show
                            <div class="content-display clearfix">

                                @section('card-layout')
                                @show

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


    @include('system.layouts.layoutFooter')
    @yield('scripts')
</body>

</html>