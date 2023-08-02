<div class="main-header sticky side-header nav nav-item">
        <div class="container-fluid">
            <div class="main-header-left ">
                <div class="app-sidebar__toggle mobile-toggle" data-toggle="sidebar">
                    <a class="open-toggle" href="#"><i class="header-icons" data-eva="menu-outline"></i></a>
                    <a class="close-toggle" href="#"><i class="header-icons" data-eva="close-outline"></i></a>
                </div>
                <div class="main-header-center ml-3 d-sm-none d-md-none d-lg-block">
                    <input type="search" class="form-control" placeholder="Search for anything...">
                    <button class="btn"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="main-header-center">
                <div class="responsive-logo">
                    <a href="#">
                        <img src="{{ asset('https://dogecaramelo.com.br/wp-content/uploads/2023/05/logo-transparente.fw_.png')}}" class="mobile-logo" alt="dogecaramelo">
                    </a>
                </div>
            </div>
            <div class="main-header-right">
                <div class="nav nav-item  navbar-nav-right ml-auto">
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
                    <!-- Full-screen  -->
                    <div class="nav-item full-screen fullscreen-button">
                        <a class="new nav-link full-screen-link" href="#"><i class="ti-fullscreen"></i></a>
                    </div>

                    <!-- message  -->
                    <div class="dropdown  nav-item main-header-message ">
                        <a class="new nav-link" href="#"><i class="ti-email"></i><span class="pulse-danger"></span></a>
                        <div class="dropdown-menu dropdown-menu-arrow animated fadeInUp ">
                            <div class="main-dropdown-header  d-sm-none">
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
                            <div class="main-message-list chat-scroll">
                                <a href="#" class="p-3 d-flex border-bottom">
                                    <div class="  drop-img  cover-image  " data-image-src="{{ asset('https://laravel.spruko.com/xino/ltr/assets/img/faces/3.jpg')}}">
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
                                    <div class="drop-img cover-image" data-image-src="{{ asset('https://laravel.spruko.com/xino/ltr/assets/img/faces/2.jpg')}}">
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
                                    <div class="drop-img cover-image" data-image-src="{{ asset('https://laravel.spruko.com/xino/ltr/assets/img/faces/9.jpg')}}">
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
                                    <div class="drop-img cover-image" data-image-src="{{ asset('https://laravel.spruko.com/xino/ltr/assets/img/faces/12.jpg')}}">
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
                                    <div class="drop-img cover-image" data-image-src="{{ asset('https://laravel.spruko.com/xino/ltr/assets/img/faces/5.jpg')}}">
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

                    <!-- notifications  -->
                    <div class="dropdown nav-item main-header-notification">
                        <a class="new nav-link " href="#"><i class="ti-bell animated bell-animations"></i><span class=" pulse"></span></a>
                        <div class="dropdown-menu dropdown-menu-arrow animated fadeInUp">
                            <div class="menu-header-content text-left d-flex">
                                <div class>
                                    <h6 class="menu-header-title text-white mb-0">7 new Notifications</h6>
                                </div>
                                <div class="my-auto ml-auto">
                                    <span class="badge badge-pill badge-warning float-right">Mark All Read</span>
                                </div>
                            </div>
                            <div class="main-notification-list Notification-scroll">
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
                    <!-- profile -->
                    <button class="navbar-toggler navresponsive-toggler d-sm-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon fe fe-more-vertical "></span>
                    </button>
                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                        <a class="profile-user" href><img alt src="{{ asset('images/5.jpg')}}"></a>
                        <div class="dropdown-menu dropdown-menu-arrow animated fadeInUp">
                            <div class="main-header-profile header-img">
                                <div class="main-img-user"><img alt src="{{ asset('images/5.jpg')}}"></div>
                                <h6 class="nome-user-dog">{{auth()->user()->name ?? ''}}</h6>
                                <!-- <span class="email-user-doc">Premium Member</span> -->
                            </div>
                            <a class="dropdown-item" href><i class="far fa-user"></i> Meu Perfil</a>
                            <a class="dropdown-item" href><i class="far fa-edit"></i> Editar Perfil</a>
                            <a class="dropdown-item" href><i class="far fa-clock"></i> Registros de atividades</a>
                            <a class="dropdown-item" href><i class="fas fa-sliders-h"></i> Configuração da Conta</a>
                            <a class="dropdown-item options-logout-user" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Sair</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>