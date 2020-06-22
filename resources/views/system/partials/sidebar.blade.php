<div class="nav-sidebar">
  <div class="inner-navbar clearfix">
    {{--<ul class="ul-sidebar" id="accordion">
      @foreach(module in modules())
      @if(hasPermissionOnModule(module) && showInSidebar(module.showInSidebar))
        @if(module.hasSubmodules)
          <li class="panel">
            <a data-toggle="collapse" data-parent="#accordion" href="#sidenav{{$loop.index}}" class="arw collapsed">
              {{{module.icon || ''}}}
              <span class="span-link">{{trans(module.name)}}</span>
            </a>
            <ul id="sidenav{{$loop.index}}" class="collapse">
              <li><a href="#"></a></li>
              @each(subModule in module.submodules)
              @if(hasPermission(subModule.route, 'get'))
                <li>
                  <a href="/{{prefix}}{{subModule.route}}">
                    {{{subModule.icon || ''}}} <span class="span-link">{{trans(subModule.name)}}</span>
                  </a>
                </li>
              @endif
              @endeach
            </ul>
          </li>
        @else
          <li>
            @if(hasPermission(module.route, 'get'))
              <a href="/{{prefix}}{{module.route}}">
                {{{module.icon || ''}}}<span class="span-link">{{trans(module.name)}}</span>
              </a>
            @endif
          </li>
        @endif
      @endif
      @endeach
    </ul>--}}
    <a class="toggle-button" role="button" title="Toggle sidebar" type="button">
      <span>{{trans('Collapse Sidebar')}}</span>
    </a>
  </div><!-- ends inner-navbar -->
</div><!-- ends nav-sidebar -->
