<header class="header-navbar" style="background-color: {{ getCmsConfig('cms theme color') }}">
  <div class="container-fluid">
    <div class="header-content clearfix">
      <div class="header-left clearfix pull-left">
        <h1 class="pull-left logo-tag">
          <a href="{{route('home')}}">
            <img src="{{asset('uploads/config/')}}/{{ getCmsConfig('cms logo')}}" alt="" height="20">
            <span>{{getCmsConfig('cms title')}}</span>
          </a>
        </h1>
      </div>

      <div class="header-right clearfix pull-right">
        <ul class="nav nav-pills">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="localeDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{$globalLocale}}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="localeDropDown">
              @foreach($globalLanguages as $lang)
              <a href="{{'/'.PREFIX.'/languages/set-language?lang='.$lang->language_code}}" class="dropdown-item"
              onclick="setLang(event, '{{$lang->language_code}}')">
              {{$lang->name}} ({{$lang->language_code}})
              </a>
              @endforeach
            </div>
          </li>

          <li class="nav-item dropdown header-user">
            <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="header-avatar js-lazy-loaded" src="{{asset('images/avatar.jpg')}}" width="23" height="23">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropDown">
              <div class="li-user dropdown-item">
                <h2>{{Auth::user()->name}}</h2>
                <p>{{Auth::user()->username}}({{Auth::user()->role->name}})</p>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ trans('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <script>
    function setLang(event, lang) {
      event.preventDefault()
      document.cookie = 'username=;'
      document.cookie = 'lang=' + lang
      window.location.href = event.target.getAttribute('href')
    }
  </script>
</header>