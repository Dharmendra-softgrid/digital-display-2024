<style>
  /* Add the following CSS for hover effect */
  .nav-item:hover .dropdown-menu {
      display: block;
  }

  /* Add the following CSS to hide the dropdown menu by default */
  .dropdown-menu {
      display: none;
      position: absolute;
      z-index: 1;
      background-color: #f9f9f9;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }
  .display-style{
    list-style: none;
  }
  .menu-text-case{
    text-transform: uppercase;
  }
</style>
<header class="header_sec">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
             <img src="{{asset('/')}}images/logo.png" alt="logo">
          </a>
          <div class="mobile-search-menu desktop_hide">
                <a class="nav_search" href="javascript:void(0)">
                  <img class="black-search" src="{{asset('/')}}images/Searchblack.svg">
                </a>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto main_menu">
              <li class="nav-item ">
                <a class="nav-link {{ request()->is('aboutus') ? 'active' : '' }}" href="{{route('aboutus')}}">ABOUT US</a>
              </li>
           
              <li class="nav-item main_child">
                <a class="nav-link drop_togl_inr" href="javascript:void(0)">
                SOLUTIONS
                </a>
                <div class="dropdown-menu sub_menu second_level_menu ">
                  <ul class="navbar-nav-menu">
                    @if($menus->isNotEmpty())
                        @foreach($menus as $menu)
                            @if($menu->children->isNotEmpty())
                                <li class="nav-item has_child menu-text-case">
                                    <a href="javascript:void(0)" class="dropdown-item drop_togl_inr">{{$menu->title}}</a>

                                    <ul class="dropdown-menu sub_menu" style="display: none;">
                                        @foreach($menu->children as $child)
                                            @if($child->children->isNotEmpty())
                                                <li class="has_child">
                                                    @if(!empty($child->page) && $child->page != null && $child->page != 0)
                                                      <a class="dropdown-item drop_togl_inr {{ request()->url() == route('displaysolutions', ['slug' => $child->slug]) ? 'active' : '' }}" href="{{route('displaysolutions', ['slug' => $child->slug])}}">{{$child->title}}</a>
                                                       <span class=""></span>
                                                      @else
                                                      <a href="javascript:void(0)" class="dropdown-item drop_togl_inr">{{$child->title}}</a>
                                                      
                                                    @endif
                                                    <ul class="sub_menu third_level_menu" style="display: none;">
                                                        @foreach($child->children as $subChild)
                                                            @if(!empty($subChild->page) && $subChild->page != null && $subChild->page != 0)
                                                                <li class="menu-text-case"> 
                                                                  <a class="dropdown-item  {{ request()->url() == route('displaysolutions', ['slug' => $subChild->slug]) ? 'active' : '' }}" href="{{route('displaysolutions', ['slug' => $subChild->slug])}}">{{$subChild->title}}</a>
                                                                  
                                                                </li>
                                                            @else
                                                                <li class="menu-text-case"> <a href="javascript:void(0)" class="dropdown-item ">{{$subChild->title}}</a><span class="drop_togl_inr"></span></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                @if(!empty($child->page) && $child->page != null && $child->page != 0)
                                                    <li class="menu-text-case"> <a class="dropdown-item menu-text-case {{ request()->url() == route('displaysolutions', ['slug' => $child->slug]) ? 'active' : '' }}" href="{{route('displaysolutions', ['slug' => $child->slug])}}">{{$child->title}}</a></li>
                                                @else
                                                    <li class="menu-text-case"><a href="javascript:void(0)" class="dropdown-item menu-text-case">{{$child->title}}</a></li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item has_child menu-text-case">
                                    <a href="{{$menu->link}}">{{$menu->title}} <i class="fas fa-external-link-alt"></i></a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
              </div>

                
              </li>
              <li class="nav-item main_child">
                <a class="nav-link drop_togl_inr" href="javascript:void(0)">INDUSTRIES</a>
                <div class="dropdown-menu second_level_menu">
                    <ul class="navbar-nav-menu display-style">
                        @foreach($industries as $i)
                            <li class="nav-item">
                                <a class="dropdown-item {{ request()->route()->named('industry') && request()->route('slug') == $i->slug ? 'active' : '' }}" href="{{route('industry', ['slug' => $i->slug])}}">{{$i->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
              </li>
            
            
              <li class="nav-item ">
                <a class="nav-link {{ request()->is('success-stories') ? 'active' : '' }}" href="{{route('success-stories')}}">Success Stories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('news-and-blogs') ? 'active' : '' }}" href="{{route('news-and-blogs')}}">NEWS & BLOGS</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto right-nav inquire-now-menu mobile_hide">
              <li class="nav-item">
                <a class="nav_search" href="#">
                  <img class="black-search" src="{{asset('/')}}images/Searchblack.svg">
                </a>
              </li>
                  <li class="nav-item">
                      <a class="inquire-now-link {{ request()->is('inquire-now') ? 'active' : '' }}" href="{{route('inquire-now')}}">ENQUIRE NOW</a>
                  </li>
              </ul>
            <ul class="social_main mobile_mene_soc">
              <li><a href="#" class="social_fb"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#" class="social_insta"><i class="fab fa-instagram"></i></a></li>
              <li><a href="#" class="social_twitter"><i class="fab fa-twitter"></i></a></li>
              <li><a href="#" class="social_yt"><i class="fab fa-youtube"></i></a></li>
            </ul> 
          </div>
        </div>

        <div class="Search_bar" >
              <form class="form-inline" action="{{ route('search') }}" method="GET">
                <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit"><img class="black-search" src="{{asset('/')}}images/Searchblack.svg"></button>
              </form>

              <a href="#" class="btn-close"></a>
            </div>



      </nav>
    </header>

<div class="header_space"></div>