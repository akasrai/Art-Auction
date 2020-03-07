<div class="col-md-3 left_col">
   <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
         <a href="/admin" class="site_title"><i class="fa fa-paw"></i> <span><span
                  style="color:red;">Zorig</span>Auction</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
         <div class="menu_section">
            <ul class="nav side-menu">
               <li><a href="/admin"><i class="fa fa-home"></i> @lang('navbar.dashboard')</span></a></li>

               <!-- <li><a><i class="fa fa-trello"></i> @lang('navbar.category') <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                     <li><a href="/admin/category">@lang('navbar.categoryList')</a></li>
                  </ul>
               </li> -->

               <li><a><i class="fa fa-pied-piper-pp"></i> @lang('navbar.product') <span
                        class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                     <li><a href="/admin/category/create">@lang('navbar.createCategory')</a></li>
                     <li><a href="/admin/product/create">@lang('navbar.createProduct')</a></li>
                     <li><a href="/admin/products">@lang('navbar.productList')</a></li>
                  </ul>
               </li>

               <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i> @lang('navbar.auction') <span
                        class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                     <li><a href="/admin/auctions">@lang('navbar.viewAuctionList')</a></li>
                  </ul>
               </li>

               <li><a><i class="fa fa-shopping-cart" aria-hidden="true"></i> @lang('navbar.orders') <span
                        class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                     <li><a href="/admin/orders">@lang('navbar.viewOrders')</a></li>
                  </ul>
               </li>
               <!-- 
               <li><a><i class="fa fa-edit"></i> @lang('navbar.blogs') <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                     <li><a href="/admin/blog">@lang('navbar.blogList')</a></li>
                     <li><a href="/admin/blog/create">@lang('navbar.createBlog')</a></li>
                  </ul>
               </li> -->

               @if(Auth::user()->isSuperAdmin())
               <li><a><i class="fa fa-user"></i> @lang('navbar.users') <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                     <li><a href="/admin/register">@lang('navbar.createUser')</a></li>
                     <li><a href="/admin/userlist">@lang('navbar.userList')</a></li>
                  </ul>
               </li>
               @endif
            </ul>
         </div>
      </div>
      <!-- /sidebar menu -->

      <!-- /menu footer buttons -->
      <!-- <div class="sidebar-footer hidden-small">
         <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
         </a>
         <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
         </a>
         <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
         </a>
         <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('admin.logout') }}">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
         </a>
      </div> -->
      <!-- /menu footer buttons -->
   </div>
</div>

<!-- top navigation -->
<div class="top_nav">
   <div class="nav_menu">
      <nav>
         <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
         </div>

         <ul class="nav navbar-nav navbar-right">
            <li class="">
               <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('images/profiles/dp.png') }}" alt="">{{ Auth::user()->fname }}
                  <span class=" fa fa-angle-down"></span>
               </a>
               <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="javascript:;"> Profile</a></li>
                  <li>
                     <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                     </a>
                  </li>
                  <li><a href="javascript:;">Help</a></li>
                  <li>
                     <a href="{{ route('admin.logout') }}">
                        <i class="fa fa-sign-out pull-right"></i> Log Out
                     </a>
                  </li>
               </ul>
            </li>

            <!-- NOTIFICATIONS -->
            <!-- <li role="presentation" class="dropdown">
               <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
               </a>
               <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                     <a>
                        <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}"
                              alt="Profile Image" /></span>
                        <span>
                           <span>Akas Rai</span>
                           <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                           Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                     </a>
                  </li>
                  <li>
                     <a>
                        <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}"
                              alt="Profile Image" /></span>
                        <span>
                           <span>Akas Rai</span>
                           <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                           Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                     </a>
                  </li>
                  <li>
                     <a>
                        <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}"
                              alt="Profile Image" /></span>
                        <span>
                           <span>Akas Rai</span>
                           <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                           Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                     </a>
                  </li>
                  <li>
                     <a>
                        <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}"
                              alt="Profile Image" /></span>
                        <span>
                           <span>Akas Rai</span>
                           <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                           Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                     </a>
                  </li>
                  <li>
                     <div class="text-center">
                        <a>
                           <strong>See All Alerts</strong>
                           <i class="fa fa-angle-right"></i>
                        </a>
                     </div>
                  </li>
               </ul>
            </li> -->
         </ul>
      </nav>
   </div>
</div>
<!-- /top navigation -->