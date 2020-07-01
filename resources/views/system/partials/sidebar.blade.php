<div class="nav-sidebar">
  <div class="inner-navbar clearfix">
    <ul class="ul-sidebar" id="accordion">
      @foreach($modules as $module)
      @if(\ekHelper::hasPermissionOnModule($module) && showInSideBar($module['showInSideBar'] ?? true))
      @if($module['hasSubmodules'])
      <li class="panel">
        <a data-toggle="collapse" data-parent="#accordion" href="#sidenav{{$loop->index}}" class="arw collapsed">
          {!! $module['icon'] ?? ''!!}<span class="span-link">{{trans($module['name'])}}</span>
        </a>
        <ul id="sidenav{{$loop->index}}" class="collapse">
          <li><a href="#"></a></li>
          @foreach($module['submodules'] as $subModule)
          @if(\ekHelper::hasPermission($subModule['route'], 'get'))
          <li>
            <a href="/{{PREFIX.$subModule['route']}}">
              {!! $subModule['icon'] ?? ''!!} <span class="span-link">{{trans($subModule['name'])}}</span>
            </a>
          </li>
          @endif
          @endforeach
        </ul>
      </li>
      @else
      <li>
        @if(\ekHelper::hasPermission($module['route'], 'get'))
        <a href="/{{PREFIX.$module['route']}}">
          {!! $module['icon'] ?? ''!!}<span class="span-link">{{trans($module['name'])}}</span>
        </a>
        @endif
      </li>
      @endif
      @endif
      @endforeach
    </ul>
    <a class="toggle-button" role="button" title="Toggle sidebar" type="button">
      <span>{{trans('Collapse Sidebar')}}</span>
    </a>
  </div><!-- ends inner-navbar -->
</div><!-- ends nav-sidebar -->