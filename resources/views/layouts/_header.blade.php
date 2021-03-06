<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-static-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="{{ route('root') }}"><img src="{{ asset('/other_images/logo2.jpg') }}" alt="logo" ></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item nav-top-title {{ active_class(if_route('topics.index')) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('topics.index') }}">Topics</a>
          </li>
          <li class="nav-item nav-top-title {{ active_class((if_route('categories.show') && if_route_param('category',1))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 1) }}">Share</a>
          </li>
          <li class="nav-item nav-top-title {{ active_class((if_route('categories.show') && if_route_param('category',2))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 2) }}">Courses</a>
          </li>
          <li class="nav-item nav-top-title {{ active_class((if_route('categories.show') && if_route_param('category',3))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 3) }}">Q&A</a>
          </li>
          <li class="nav-item nav-top-title {{ active_class((if_route('categories.show') && if_route_param('category',4))) }}">
              <a class="nav-link js-scroll-trigger" href="{{ route('categories.show', 4) }}">News</a>
          </li>
          @guest
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('login') }}"><i class="fa fa-user-o nav-top-title"  aria-hidden="true"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('register') }}"><i class="fa fa-user-plus nav-top-title" aria-hidden="true"></i></a>
          </li>
          @else
          {{-- 消息通知標記 --}}
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{ route('notifications.index') }}">
                <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'warning':'light'}}" title="消息提醒">
                  {{ Auth::user()->notification_count }}
                </span>
              </a>
          </li>
          <li class="nav-item dropdown nav-img">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                      <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                  </span>
                  {{ Auth::user()->name }} 
              </a>

              <ul class="dropdown-menu ml-auto shadow mb-5 bg-white rounded" role="menu">
                @can('manage_contents')
                  <li>
                      <a class="dropdown-item" href="{{ url(config('administrator.uri')) }}">
                        <span><i class="fa fa-cog font-awe" style="color:OLIVE" aria-hidden="true"></i></span>
                         管理後台
                      </a>
                  </li>
                @endcan

                  <li>
                      <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">
                        <span><i class="fa fa-user-circle font-awe" style="color:SANDYBROWN" aria-hidden="true"></i></span>
                         個人中心
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
                        <span><i class="fa fa-pencil-square-o font-awe" style="color:GOLD" aria-hidden="true"></i></span>
                        編輯個人資料
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          <span><i class="fa fa-share-square font-awe" style="color:LIGHTGREY" aria-hidden="true"></i></span>
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