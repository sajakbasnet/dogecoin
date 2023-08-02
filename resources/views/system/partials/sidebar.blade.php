<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll ">
    <div class="main-sidebar-header">
        <a class="desktop-logo logo-dark" href="#">
            <img src="{{ asset('https://dogecaramelo.com.br/wp-content/uploads/2023/05/logo-transparente.fw_.png')}}" alt="dogecaramelo">
        </a>
    </div>
    <div class="main-sidebar-body circle-animation ">
        <ul class="side-menu circle">           
            @foreach ($modules as $module)
            @if (hasPermissionOnModule($module) && showInSideBar($module['showInSideBar'] ?? true))
            @if ($module['hasSubmodules'])
            <li class="slide"><a class="side-menu__item" href="#sidenav{{$loop->index}}">
            <h3 class> {!! $module['icon'] ?? '' !!} <span>{{translate($module['name'])}}</span></h3></a>
               <ul class="side-menu circle">     
                    @foreach ($module['submodules'] as $subModule)
                    @if (hasPermission($subModule['route'], 'get'))
                 <li class="slide"><a href="{{url(getSystemPrefix().$subModule['route'])}}" class="side-menu__item">
                 <h3 class>{{translate($subModule['name'])}}</h3>
                </a></li>
                    @endif
                    @endforeach
                </ul>
            </li>
            @else
            <li class="slide">
                <a class="side-menu__item" href="{{url(getSystemPrefix().$module['route'])}}">
                    @if (hasPermission($module['route'], 'get'))
                    <h3 class> {!! $module['icon'] ?? '' !!} <span>{{translate($module['name'])}} </span></h3>
                    @endif
                </a>
            </li>
            @endif
            @endif
            @endforeach
        </ul>
    </div>
</aside>