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
                                <h3>{{$title ?? ''}}</h3>
                            </div>
                            <div class="col-12 col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"> Dashboard</li>
                                    <li class="breadcrumb-item active"> {{ $title ?? ''}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                        @yield('heading-contents')
                </div>
                @yield('contents')
            </div>
            <!-- Page Sidebar Ends-->

            <!-- footer start-->
            @include('system.layouts.layoutFooter')
            @yield('scripts')
        </div>
    </div>
</body>

</html>
