 <nav class="navbar navbar-default navbar-static-top navbar-custom">
     <div class="container padding-left-right">
         <div class="navbar-header">

             <!-- Collapsed Hamburger -->
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                 data-target="#app-navbar-collapse" aria-expanded="false">
                 <span class="sr-only">Toggle Navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>

             <!-- Branding Image -->
             <a class="navbar-brand" href="{{ url('/') }}">
                 {{ config('app.name', 'Zorig Auction') }}
             </a>
         </div>

         <div class="collapse navbar-collapse cart-icon-sum-wrapper" id="app-navbar-collapse">
             <!-- Right Side Of Navbar -->
             <div class="col-md-6 col-sm-12 col-xs-12">
                 @include('inc.searchbar')
             </div>
             <ul class="nav navbar-nav navbar-right">
                 <!-- Authentication Links -->
                 @guest
                 <li><a href="{{ route('register') }}" class="btn btn-primary sign-up-button">Sign Up</a></li>
                 <li><a href="{{ route('login') }}" class="sign-in-button">Sign In</a></li>
                 @else

                 <li class="dropdown" id="user-logout-option">
                     <div class="dropdown-toggle user-info-section" data-toggle="dropdown" role="button"
                         aria-expanded="false" aria-haspopup="true">
                         <div class="navbar-user-image">
                             @if(Auth::user()->image)
                             <img src="<?php echo url('storage/'.Auth::user()->image)?>"
                                 id="profile-picture" alt="profile image" />
                             @else
                             <i class="glyphicon glyphicon-user"></i>
                             @endif
                         </div>
                         <div class="user-login-name">
                             <span>{{ Auth::user()->fname }} <span class="caret"></span> </span>
                         </div>

                         <div class="user-drop-down-option hide">
                             <a href="{{ route('logout') }}"
                                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                             <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                 style="display: none;">
                                 {{ csrf_field() }}
                             </form>
                             <br />
                             <a href="/dashboard" onclick="redirectTo()">Dashboard</a>
                         </div>
                     </div>
                 </li>
                 @endguest
                 <a href=" javascript:void(0)" id="cart">
                     <li>
                         <i class="fa fa-shopping-cart" style="margin-top:9px"></i>
                         <span class="badge">38</span>
                     </li>
                     <li>
                         <span class="total-cart-amount-title">Cart</span>
                         <span class="total-cart-amount"> $50000</span>
                     </li>
                 </a>
                 @include('inc.items-in-cart')
             </ul>
         </div>
     </div>
 </nav>

 <div class="col-md-12 nav-menu-bar">
     <div class="col-md-12 container padding-left-right">
         <div class="col-md-12 clearfix">
             <div class="col-md-12 no-padding shop-by-category-wrapper">
                 <div class="col-md-2 col-sm-12 col-xs-12 shop-by-category">
                     <i class="fa fa-chevron-down"></i>&nbsp;
                     SHOP BY CATEGORY
                     <div class="category-menu-wrapper">
                         <ul class="category-list">
                             @if(count($categories)>0)
                             @foreach($categories as $category)
                             @if($category->name!='Uncategorized' && $category->name!='Featured')
                             <a
                                 href="<?php echo url('category/'.$category->slug);?>">
                                 <li>
                                     {{$category->name}}
                                     <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
                                 </li>
                             </a>
                             @endif
                             @endforeach
                             @endif
                         </ul>
                     </div>
                 </div>
                 <div class="col-md-7 no-padding">
                     <ul class="navbar-menu-items">
                         <a href="/contact">
                             <li>Contact</li>
                         </a>
                         <a href="/faq">
                             <li>FAQ</li>
                         </a>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script>
     function redirectTo() {
         window.location.href = "{{url('/dashboard')}}";
     }
 </script>