@extends('system.layouts.master')
@section('content')
<!-- main-content -->

<div class="responsive main-header collapse" id="navbarSupportedContent-4">
    <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark d-sm-none ">
        <div class="navbar-collapse">
            <div class="d-flex order-lg-2 ml-auto justify-content-between">
                <form class="navbar-form nav-item my-auto d-lg-none" role="search">
                    <div class="input-group nav-item my-auto">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="reset" class="btn btn-default">
                                <i class="ti-close"></i>
                            </button>
                            <button type="submit" class="btn btn-default nav-link">
                                <i class="ti-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <div class="d-md-flex">
                    <div class="nav-item full-screen fullscreen-button">
                        <a class="new nav-link full-screen-link" href="#"><i class="ti-fullscreen"></i></a>
                    </div>
                </div>
                <div class="dropdown  nav-item main-header-message header-contact">
                    <a class="new nav-link" href="#"><i class="ti-email"></i><span class="pulse-danger"></span></a>
                    <div class="dropdown-menu dropdown-menu-arrow animated fadeInUp">
                        <div class="main-dropdown-header d-sm-none">
                            <a class="main-header-arrow" href><i class="icon ion-md-arrow-back"></i></a>
                        </div>
                        <div class="menu-header-content text-left d-flex">
                            <div class>
                                <h6 class="menu-header-title text-white mb-0">5 new Messages</h6>
                            </div>
                            <div class="my-auto ml-auto">
                                <span class="badge badge-pill badge-warning float-right">Mark All Read</span>
                            </div>
                        </div>
                        <div class="main-message-list text-scroll">
                            <a href="#" class="p-3 d-flex border-bottom">
                                <div class="  drop-img  cover-image  " data-image-src="https://laravel.spruko.com/xino/ltr/assets/img/faces/3.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>

                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Paul Molive</h5>
                                        <p class="time mb-0 text-right ml-auto float-right">10 min ago</p>
                                    </div>
                                    <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
                                </div>
                            </a>
                            <a href="#" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="https://laravel.spruko.com/xino/ltr/assets/img/faces/2.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Sahar Dary</h5>
                                        <p class="time mb-0 text-right ml-auto float-right">13 min ago</p>
                                    </div>
                                    <p class="mb-0 desc">All set ! Now, time to get to you now......</p>
                                </div>
                            </a>
                            <a href="#" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="https://laravel.spruko.com/xino/ltr/assets/img/faces/9.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Khadija Mehr</h5>
                                        <p class="time mb-0 text-right ml-auto float-right">20 min ago</p>
                                    </div>
                                    <p class="mb-0 desc">Are you ready to pickup your Delivery...</p>
                                </div>
                            </a>
                            <a href="#" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="https://laravel.spruko.com/xino/ltr/assets/img/faces/12.jpg">
                                    <span class="avatar-status bg-danger"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Barney Cull</h5>
                                        <p class="time mb-0 text-right ml-auto float-right">30 min ago</p>
                                    </div>
                                    <p class="mb-0 desc">Here are some products ...</p>
                                </div>
                            </a>
                            <a href="#" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="https://laravel.spruko.com/xino/ltr/assets/img/faces/5.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Petey Cruiser</h5>
                                        <p class="time mb-0 text-right ml-auto float-right">35 min ago</p>
                                    </div>
                                    <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
                                </div>
                            </a>
                        </div>
                        <div class="text-center dropdown-footer">
                            <a href="text-center">VIEW ALL</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown nav-item main-header-notification">
                    <a class="new nav-link" href="#"><i class="ti-bell "></i><span class=" pulse"></span></a>
                    <div class="dropdown-menu dropdown-menu-arrow animated fadeInUp">
                        <div class="menu-header-content text-left d-flex">
                            <div class>
                                <h6 class="menu-header-title text-white mb-0">7 new Notifications</h6>
                            </div>
                            <div class="my-auto ml-auto">
                                <span class="badge badge-pill badge-warning float-right">Mark All Read</span>
                            </div>
                        </div>
                        <div class="main-notification-list notify-scroll">
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-success-transparent">
                                    <i class="la la-shopping-basket text-success"></i>
                                </div>
                                <div class="ml-3">
                                    <h5 class="notification-label mb-1">New Order Received</h5>
                                    <div class="notification-subtext">1 hour ago</div>
                                </div>
                                <div class="ml-auto">
                                    <i class="las la-angle-right text-right text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-danger-transparent">
                                    <i class="la la-user-check text-danger"></i>
                                </div>
                                <div class="ml-3">
                                    <h5 class="notification-label mb-1">22 verified registrations</h5>
                                    <div class="notification-subtext">2 hour ago</div>
                                </div>
                                <div class="ml-auto">
                                    <i class="las la-angle-right text-right text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-primary-transparent">
                                    <i class="la la-check-circle text-primary"></i>
                                </div>
                                <div class="ml-3">
                                    <h5 class="notification-label mb-1">Project has been approved</h5>
                                    <div class="notification-subtext">4 hour ago</div>
                                </div>
                                <div class="ml-auto">
                                    <i class="las la-angle-right text-right text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-pink-transparent">
                                    <i class="la la-file-alt text-pink"></i>
                                </div>
                                <div class="ml-3">
                                    <h5 class="notification-label mb-1">New files available</h5>
                                    <div class="notification-subtext">10 hour ago</div>
                                </div>
                                <div class="ml-auto">
                                    <i class="las la-angle-right text-right text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-warning-transparent">
                                    <i class="la la-envelope-open text-warning"></i>
                                </div>
                                <div class="ml-3">
                                    <h5 class="notification-label mb-1">New review received</h5>
                                    <div class="notification-subtext">1 day ago</div>
                                </div>
                                <div class="ml-auto">
                                    <i class="las la-angle-right text-right text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3" href="#">
                                <div class="notifyimg bg-purple-transparent">
                                    <i class="la la-gem text-purple"></i>
                                </div>
                                <div class="ml-3">
                                    <h5 class="notification-label mb-1">Updates Available</h5>
                                    <div class="notification-subtext">2 days ago</div>
                                </div>
                                <div class="ml-auto">
                                    <i class="las la-angle-right text-right text-muted"></i>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer">
                            <a href>VIEW ALL</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user" href><img alt src="{{ asset('images/5.jpg')}}"></a>
                    <div class="dropdown-menu dropdown-menu-arrow animated fadeInUp">
                        <div class="main-header-profile header-img">
                            <div class="main-img-user"><img alt src="{{ asset('images/5.jpg')}}"></div>
                            <h6 class="nome-user-dog">Elizabeth Jane</h6>
                            <span class="email-user-doc">Premium Member</span>
                        </div>
                        <a class="dropdown-item" href><i class="far fa-user"></i> Meu Perfil</a>
                        <a class="dropdown-item" href><i class="far fa-edit"></i> Editar Perfil</a>
                        <a class="dropdown-item" href><i class="far fa-clock"></i> Registros de atividades</a>
                        <a class="dropdown-item" href><i class="fas fa-sliders-h"></i> Configuração da Conta</a>
                        <a class="dropdown-item options-logout-user" href="login.html"><i class="fas fa-sign-out-alt"></i>Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile-header -->

<!-- container -->
<div class="container-fluid">


    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <h3 class="content-title mb-2">Dashboard</h3>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- row  -->
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class=" overflow-hidden bg-transparent card-crypto-scroll shadow-none">
                <div class="js-conveyor-example">
                    <ul class="news-crypto">
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class="d-flex">
                                        <div class="my-auto">
                                            <img src="fonts/Augur.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">REP / INR</p>
                                            <div class="m-0 tx-13 text-warning">$0.0215<span class="text-danger ml-2"><i class="ion-arrow-down-c mr-1"></i>-0.78%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class="d-flex">
                                        <div class>
                                            <img src="fonts/AquariusCoin.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">ARCO / INR</p>
                                            <div class="m-0 tx-13 text-warning">$425.25<span class="text-success ml-2"><i class="ion-arrow-up-c mr-1"></i>+12.85%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class="d-flex">
                                        <div class>
                                            <img src="fonts/BitShares.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">BTS / INR</p>
                                            <div class="m-0 tx-13 text-warning">$2.786<span class="text-success ml-2"><i class="ion-arrow-up-c mr-1"></i>-02.25%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class="d-flex">
                                        <div class>
                                            <img src="fonts/Bytecoin.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">BCN / INR</p>
                                            <div class="m-0 tx-13 text-warning">$15.425<span class="text-danger ml-2"><i class="ion-arrow-down-c mr-1"></i>-0.78%</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class="my-auto">
                                            <img src="fonts/Dash.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">Dash / INR</p>
                                            <div class="m-0 tx-13 text-warning">$5.125<span class="text-success ml-2"><i class="ion-arrow-up-c mr-1"></i>-11.85%%</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class>
                                            <img src="fonts/EOS.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">EUR / INR</p>
                                            <div class="m-0 tx-13 text-warning">$135.425<span class="text-danger ml-2"><i class="ion-arrow-down-c mr-1"></i>-0.78%</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class>
                                            <img src="fonts/Decred.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">ETH / USDT</p>
                                            <div class="m-0 tx-13 text-warning">$34.625<span class="text-success ml-2"><i class="ion-arrow-up-c mr-1"></i>-0.32%</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class>
                                            <img src="fonts/IOTA.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">IOTA / USD</p>
                                            <div class="m-0 tx-13 text-warning">$67.325<span class="text-danger ml-2"><i class="ion-arrow-down-c mr-1"></i>-0.78%</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class>
                                            <img src="fonts/Litecoin.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">LTC / USD</p>
                                            <div class="m-0 tx-13 text-warning">$7.525<span class="text-success ml-2"><i class="ion-arrow-up-c mr-1"></i>-1.42%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class>
                                            <img src="fonts/Monero.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">XMR / EUR</p>
                                            <div class="m-0 tx-13 text-warning">$4.325<span class="text-danger ml-2"><i class="ion-arrow-down-c mr-1"></i>-0.78%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class>
                                            <img src="fonts/NEM.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">ETH / USDT</p>
                                            <div class="m-0 tx-13 text-warning">$5.525<span class="text-success ml-2"><i class="ion-arrow-up-c mr-1"></i>-1.32%</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="crypto-card">
                                <div class="row">
                                    <div class=" d-flex">
                                        <div class>
                                            <img src="fonts/Netko-coin.svg" class="w-6 h-6 mt-0" alt>
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1 tx-13">NEO / USD</p>
                                            <div class="m-0 tx-13 text-warning">$6.025<span class="text-danger ml-2"><i class="ion-arrow-down-c mr-1"></i>-0.78%</span></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="card crypto crypt-primary overflow-hidden">
                <div class="card-body iconfont text-left">
                    <div class="media">
                        <div class="coin-logo bg-primary-transparent">
                            <i class="cf cf-eth text-primary"></i>
                        </div>
                        <div class="media-body">
                            <h6>Ethereum</h6>
                            <p>ETH (USD) = $148.46 (<span class="text-danger">-12.24%</span>)</p>
                        </div>
                        <div class="card-body-top mb-3">
                            <div>
                                <a href>14</a> USD Markets
                            </div>
                            <div>
                                <a href>82</a> LTC Markets
                            </div>
                        </div>
                    </div>
                    <div class="flot-wrapper">
                        <div class="flot-chart ht-150 mt-4" id="flotChart3"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <nav class="nav">
                        <a class="nav-link active" href><span>1D</span><span>-12.24%</span></a> <a class="nav-link" href><span>1W</span><span>-16.48%</span></a> <a class="nav-link" href><span>1M</span><span>-15.21%</span></a>
                        <a class="nav-link" href><span>1Y</span><span>-40.17%</span></a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="card crypto crypt-danger overflow-hidden">
                <div class="card-body iconfont text-left">
                    <div class="media">
                        <div class="coin-logo bg-danger-transparent">
                            <i class="cf cf-ltc tx-18 text-danger"></i>
                        </div>
                        <div class="media-body">
                            <h6>Litecoin</h6>
                            <p>LTC (USD) = $45.81 (<span class="text-danger">-12.24%</span>)</p>
                        </div>
                        <div class="card-body-top">
                            <div>
                                <a href>21</a> USD Markets
                            </div>
                            <div>
                                <a href>56</a> LTC Markets
                            </div>
                        </div>
                    </div>
                    <div class="flot-wrapper">
                        <div class="flot-chart ht-150  mt-4" id="flotChart5"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <nav class="nav">
                        <a class="nav-link active" href><span>1D</span><span>-15.24%</span></a> <a class="nav-link" href><span>1W</span><span>-24.68%</span></a> <a class="nav-link" href><span>1M</span><span>-17.15%</span></a>
                        <a class="nav-link" href><span>1Y</span><span>-30.23%</span></a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12">
            <div class="card crypto  crypt-success overflow-hidden">
                <div class="card-body iconfont text-left">
                    <div class="media">
                        <div class="coin-logo bg-success-transparent">
                            <i class="cf cf-xrp text-success"></i>
                        </div>
                        <div class="media-body">
                            <h6>Ripple</h6>
                            <p>XRP (USD) = $0.2195(<span class="text-danger">-2.97%</span>)</p>
                        </div>
                        <div class="card-body-top">
                            <div>
                                <a href>4</a> USD Markets
                            </div>
                            <div>
                                <a href>45</a> LTC Markets
                            </div>
                        </div>
                    </div>
                    <div class="flot-wrapper">
                        <div class="flot-chart ht-150 mt-4" id="flotChart1"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <nav class="nav">
                        <a class="nav-link active" href><span>1D</span><span>-14.32%</span></a> <a class="nav-link" href><span>1W</span><span>-24.39%</span></a> <a class="nav-link" href><span>1M</span><span>-42.12%</span></a>
                        <a class="nav-link" href><span>1Y</span><span>-50.34%</span></a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- row -->
    <div class="row row-sm row-deck">
        <div class="col-xl-4 col-lg-12">
            <div class="card overflow-hidden ">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-10">Market Info</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">An activity is a scheduled phase in a project plan with a
                        distinct beginning and end. <a href>Learn more</a></p>
                </div>
                <div class="card-body p-0">
                    <div class>
                        <div class="list d-flex align-items-center border-bottom p-2 pl-3 pr-3 mt-0">
                            <img class="w-6 h-6" src="fonts/Bitcoin.svg" alt="image">
                            <div class="w-100 ml-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mt-1 mb-0 font-weight-semibold">BTC/USD</p>
                                    <span class="ml-auto fs-15 mb-0 font-weight-semibold">$10,245.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success tx-13"><i class="fa fa-caret-up mr-1"></i>2.04%</span>
                                    <small class="text-muted ml-auto">340.5 USD</small>
                                </div>
                            </div>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-2 pl-3 pr-3">
                            <img class="w-6 h-6" src="fonts/Ethereum.svg" alt="image">
                            <div class="w-100 ml-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mt-1 mb-0 font-weight-semibold">ETH/USD</p>
                                    <span class="ml-auto fs-15 mb-0 font-weight-semibold">$15,183.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger tx-13"><i class="fa fa-caret-down mr-1"></i>1.25%</span>
                                    <small class="text-muted ml-auto">283.5 USD</small>
                                </div>
                            </div>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-2 pl-3 pr-3">
                            <img class="w-6 h-6" src="fonts/Litecoin.svg" alt="image">
                            <div class="w-100 ml-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mt-1 mb-0 font-weight-semibold">LTC/USD</p>
                                    <span class="ml-auto fs-15 mb-0 font-weight-semibold">$14,348.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger tx-13"><i class="fa fa-caret-down mr-1"></i>1.04%</span>
                                    <small class="text-muted ml-auto">368.2 USD</small>
                                </div>
                            </div>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-2 pl-3 pr-3">
                            <img class="w-6 h-6" src="fonts/Dash.svg" alt="image">
                            <div class="w-100 ml-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mt-1 mb-0 font-weight-semibold">Dash/USD</p>
                                    <span class="ml-auto fs-15 mb-0 font-weight-semibold">$12,157.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success tx-13"><i class="fa fa-caret-up mr-1"></i>2.04%</span>
                                    <small class="text-muted ml-auto">127.3 USD</small>
                                </div>
                            </div>
                        </div>
                        <div class="list d-flex align-items-center p-2 pl-3 pr-3 mb-0">
                            <img class="w-6 h-6" src="fonts/NEM.svg" alt="image">
                            <div class=" w-100 ml-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mt-1 mb-0 font-weight-semibold">BTC/USD</p>
                                    <span class="ml-auto fs-15 mb-0 font-weight-semibold">$11,183.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success tx-13"><i class="fa fa-caret-up mr-1"></i>1.04%</span>
                                    <small class="text-muted ml-auto ">165.8 USD</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="card card-bitcoin">
                <div class=" card-minimal-two">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Bitcoin / USD Rate</h4>
                        <div class>
                            <nav class="nav nav-pills">
                                <a class="nav-link active" data-toggle="tab" href="#">BTH</a> <a class="nav-link" data-toggle="tab" href="#">ETH</a> <a class="nav-link" data-toggle="tab" href="#">LTC</a> <a class="nav-link" data-toggle="tab" href="#">BTG</a>
                            </nav>
                        </div><!-- card-header-right -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="media">
                        <div class="media-icon"><i class="fab fa-bitcoin"></i></div>
                        <div class="media-body">
                            <div class="row row-sm">
                                <div class="col">
                                    <label>Symbol</label>
                                    <p>BTC</p>
                                </div>
                                <div class="col-3">
                                    <label>Price Benchmark</label>
                                    <p>128.00%</p>
                                </div>
                                <div class="col">
                                    <label>Price (USD)</label>
                                    <p>$4,253.49</p>
                                </div>
                                <div class="col">
                                    <label>Change (24H)</label>
                                    <p>-0.24%</p>
                                </div>
                                <div class="col">
                                    <label>Market Cap</label>
                                    <p>$179.12B</p>
                                </div>
                            </div><!-- row -->
                        </div>
                    </div><!-- media-body -->
                    <div class="flot-wrapper">
                        <div class="flot-chart ht-226 wd-100p" id="flotChart12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row  -->

    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-4 col-lg-12">
            <div class="card overflow-hidden recent-operations-card">
                <div class="card-body p-0">
                    <div class="p-3 pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-10">Transactions History</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-0">Transaction History shows information about cash
                            deposits, cash withdrawals for your account.<a href>Learn more</a></p>
                    </div>
                    <div class="transcation-scroll">
                        <ul class="list-unstyled mg-b-0 mt-2">
                            <li class="list-item pl-3 pr-3 mb-0 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-orange-transparent tx-orange rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-btc wd-20 ht-20 text-center tx-20 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Received Bitcoin</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB01</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3  font-weight-semibold">2.0435 BTC</p>
                                    <p class="tx-11 mg-b-0  tx-gray-500"><span class="text-success">+ $25.00 </span>USD</p>
                                </div>
                            </li>
                            <li class="list-item  mb-0 pl-3 pr-3 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-teal-transparent tx-teal rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-ltc wd-20 ht-20 text-center tx-16 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Sent Litecoin</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB02</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3  font-weight-semibold">0.0147 LTC</p>
                                    <p class="tx-11 mg-b-0  tx-gray-500"><span class="text-danger">- $12.00 </span>USD</p>
                                </div>
                            </li>
                            <li class="list-item  mb-0 pl-3 pr-3 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-danger-transparent rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-eth wd-20 ht-20 text-danger tx-20 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Received Ethereum</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB03</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3 font-weight-semibold">2.0157 ETH</p>
                                    <p class="tx-11 mg-b-0  tx-gray-500"><span class="text-success">+ $24.00 </span>USD</p>
                                </div>
                            </li>
                            <li class="list-item mb-0 pl-3 pr-3 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-primary-transparent  rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-dash wd-20 ht-20 text-primary tx-20 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Sent Dash</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB04</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3 font-weight-semibold">0.032 Dash</p>
                                    <p class="tx-11 mg-b-0  tx-gray-500"><span class="text-danger">- $128.39 </span>USD</p>
                                </div>
                            </li>
                            <li class="list-item mb-0 pl-3 pr-3 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-success-transparent tx-success rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-xmr wd-20 ht-20 text-center tx-20 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Sent Bitcoin</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB05</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3  font-weight-semibold">0.0157 BTC</p>
                                    <p class="tx-11 mg-b-0 tx-gray-500"><span class="text-danger">- $149.00</span> USD</p>
                                </div>
                            </li>
                            <li class="list-item mb-0 pl-3 pr-3 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-purple-transparent tx-purple rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-xrp wd-20 ht-20 text-center tx-20 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Pending Ripple</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB06</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3 font-weight-semibold">0.0258 XRP</p>
                                    <p class="tx-11 mg-b-0 tx-gray-500"><span class="text-success">+ $235.00</span> USD</p>
                                </div>
                            </li>
                            <li class="list-item mb-0 pl-3 pr-3 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-warning-transparent tx-warning rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-btc wd-20 ht-20 text-center tx-20 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Pending Bitcoin</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB07</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3 font-weight-semibold">0.0235 BTC</p>
                                    <p class="tx-11 mg-b-0 tx-gray-500"><span class="text-success">+ $345.00</span> USD</p>
                                </div>
                            </li>
                            <li class="list-item mb-0 pl-3 pr-3 pb-3">
                                <div class="media align-items-center">
                                    <div class="wd-40 ht-40 bg-pink-transparent tx-pink rounded-circle align-items-center justify-content-center d-none d-sm-flex">
                                        <i class="cf cf-eth wd-20 ht-20 text-center tx-20 "></i>
                                    </div>
                                    <div class="media-body mg-sm-l-15">
                                        <p class="tx-medium mg-b-3">Sent Ethereum</p>
                                        <p class="tx-11 mg-b-0 tx-gray-500">Wallet: 03E25DAEYWZXB08</p>
                                    </div>
                                </div>
                                <div class="text-right ml-auto">
                                    <p class="mg-b-3 font-weight-semibold">0.0020 ETH</p>
                                    <p class="tx-11 mg-b-0 tx-gray-500"><span class="text-danger">- $245.00</span> USD</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-12">
            <div class="row row-sm">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body text-center crypto-buy-sell">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title ">Buy Crypto Coins</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                            <div class="form-group mt-1">
                                <label class="form-label float-left">Enter Your Money</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="10,000">
                                    <div class="input-group-append wd-100">
                                        <select class="form-control select2 br-0 nice-select" data-placeholder="Choose one (with optgroup)">
                                            <optgroup label="Currecy">
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="INR">INR</option>
                                                <option value="GBP">GBP</option>
                                                <option value="JPY">JPY</option>
                                                <option value="RUB">RUB</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label float-left">Your Crypto Coins Converted to</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="0.254">
                                    <div class="input-group-append wd-100">
                                        <select class="form-control select2 br-0 nice-select" data-placeholder="Choose one (with optgroup)">
                                            <optgroup label="Coins">
                                                <option value="BTC">BTC</option>
                                                <option value="ETH">ETH</option>
                                                <option value="DAH">DAH</option>
                                                <option value="RIP">RIP</option>
                                                <option value="ITA">ITA</option>
                                                <option value="EOS">EOS</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-block btn-success" href="#">Buy Coins</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title ">Sell Crypto Coins</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                            <div class="form-group mt-1">
                                <label class="form-label float-left">Enter Crypto Coin</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="0.254">
                                    <div class="input-group-append wd-100">
                                        <select class="form-control select2 br-0 nice-select" data-placeholder="Choose one (with optgroup)">
                                            <optgroup label="Coins">
                                                <option value="BTC">BTC</option>
                                                <option value="ETH">ETH</option>
                                                <option value="DAH">DAH</option>
                                                <option value="RIP">RIP</option>
                                                <option value="ITA">ITA</option>
                                                <option value="EOS">EOS</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label float-left">Your Money Converted to</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="10,000">
                                    <div class="input-group-append wd-100">
                                        <select class="form-control select2 br-0 nice-select" data-placeholder="Choose one (with optgroup)">
                                            <optgroup label="Currecy">
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                                <option value="INR">INR</option>
                                                <option value="GBP">GBP</option>
                                                <option value="JPY">JPY</option>
                                                <option value="RUB">RUB</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-block btn-primary" href="#">Sell Coins</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-4">Quick Conversion</div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label float-left">From</label>
                                        <div class="input-group">
                                            <div class="input-group-append w-100">
                                                <select class="form-control select2 br-0 bg-light nice-select" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Coins">
                                                        <option value="BTC">BTC</option>
                                                        <option value="ETH">ETH</option>
                                                        <option value="DAH">DAH</option>
                                                        <option value="RIP">RIP</option>
                                                        <option value="ITA">ITA</option>
                                                        <option value="EOS">EOS</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label float-left">To</label>
                                        <div class="input-group">
                                            <div class="input-group-append w-100">
                                                <select class="form-control select2 br-0 bg-light nice-select" data-placeholder="Choose one (with optgroup)">
                                                    <optgroup label="Currecy">
                                                        <option value="USD">USD</option>
                                                        <option value="EUR">EUR</option>
                                                        <option value="INR">INR</option>
                                                        <option value="GBP">GBP</option>
                                                        <option value="JPY">JPY</option>
                                                        <option value="RUB">RUB</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label float-left">Amount</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="10">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-light">BTC</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label float-left">Price For BTC</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="15,25,457">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-light">USD</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="#"><i class="fa fa-refresh"></i> Transfer
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class>
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-10">Crypto currencies marketing values</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-2">A cryptocurrency is a new form of digital asset based
                            on a network that is distributed across a large number of computers. This
                            decentralized structure allows them to exist outside the control of governments and
                            central authorities.<a href>Learn more</a></p>
                    </div>
                    <div class="table-responsive market-values">
                        <table class="table table-bordered table-hover table-striped text-nowrap mb-0 tx-13">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Price</th>
                                    <th>% 24h</th>
                                    <th>Market Cap</th>
                                    <th>CMGR/Month</th>
                                    <th>Exchange</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td>Ethereum</td>
                                    <td><i class="cf cf-eth tx-22"></i></td>
                                    <td>$966.61</td>
                                    <td class="text-red">-6%</td>
                                    <td class="text-right">$95,270,125,036</td>
                                    <td>22.62% / 29</td>
                                    <td><a href="#" class="btn btn-sm btn-success">Transfer Now</a></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td>Bitcoin</td>
                                    <td><i class="cf cf-btc tx-22 text-orange"></i></td>
                                    <td>$10513.00</td>
                                    <td class="text-red">-7%</td>
                                    <td class="text-right">$179,470,305,923</td>
                                    <td>8.11% / 57</td>
                                    <td><a href="#" class="btn btn-sm btn-success">Transfer Now</a></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td>NEM</td>
                                    <td><i class="cf cf-xem tx-20 text-teal"></i></td>
                                    <td>$1547.00</td>
                                    <td class="text-red">-11%</td>
                                    <td class="text-right">$26,720,210,956</td>
                                    <td>21.30% / 6</td>
                                    <td><a href="#" class="btn btn-sm btn-success">Transfer Now</a></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td>Ripple</td>
                                    <td><i class="cf cf-xrp tx-22 text-primary"></i></td>
                                    <td>$1.2029</td>
                                    <td class="text-red">-11%</td>
                                    <td class="text-right">$47,649,145,657</td>
                                    <td>10.85% / 53</td>
                                    <td><a href="#" class="btn btn-sm btn-success">Transfer Now</a></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td>Litecoin</td>
                                    <td><i class="cf cf-ltc tx-20 text-muted"></i></td>
                                    <td>$173.86</td>
                                    <td class="text-red">-7%</td>
                                    <td class="text-right">$9,670,920,267</td>
                                    <td>6.87% / 57</td>
                                    <td><a href="#" class="btn btn-sm btn-success">Transfer Now</a></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td>Dash</td>
                                    <td><i class="cf cf-dash tx-22 text-purple"></i></td>
                                    <td>$0.935049</td>
                                    <td class="text-red">-11%</td>
                                    <td class="text-right">$8,415,440,999</td>
                                    <td>26.99% / 33</td>
                                    <td><a href="#" class="btn btn-sm btn-success">Transfer Now</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->


</div>
<!-- Container closed -->


<!-- main-content closed -->



@endsection