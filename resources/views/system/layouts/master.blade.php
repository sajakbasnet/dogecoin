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
            <!-- main-header -->
            @include('system.partials.header')
            @yield('content')
        </div>
        <div class="main-footer ht-40">
            <div class="container-fluid pd-t-0-f ht-100p">
                <span>Copyright © 2023 <a href="#">Doge Caramelo Coin</a>. Todos os direitos reservados.</span>
            </div>
        </div>

    </div>

    @include('system.layouts.layoutFooter')
</body>

</html>

</html>