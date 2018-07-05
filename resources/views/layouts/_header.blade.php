<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-static-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="{{ route('root') }}"><img src="{{ asset('/other_images/logo.png') }}" alt="logo"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ active_class(if_route('topics.index')) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('topics.index') }}">動態</a>
          </li>
          <li class="nav-item {{ active_class((if_route('categories.show') && if_route_param('category',1))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 1) }}">分享</a>
          </li>
          <li class="nav-item {{ active_class((if_route('categories.show') && if_route_param('category',2))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 2) }}">課程</a>
          </li>
          <li class="nav-item {{ active_class((if_route('categories.show') && if_route_param('category',3))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 3) }}">問答</a>
          </li>
          <li class="nav-item {{ active_class((if_route('categories.show') && if_route_param('category',4))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 4) }}">公告</a>
          </li>
          @guest
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('login') }}"><i class="fa fa-user-o" style="color:OLIVE" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('register') }}"><i class="fa fa-user-plus" style="color:DARKKHAKI" aria-hidden="true"></i></a>
          </li>
          @else
          <li class="nav-item dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                      <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                  </span>
                  {{ Auth::user()->name }} 
              </a>

              <ul class="dropdown-menu ml-auto" role="menu">
                  <li>
                      <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">
                          編輯個人資料
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          登出
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
              </ul>
          </li>
        @endguest

        </ul>
      </div>
    </div>
  </nav>