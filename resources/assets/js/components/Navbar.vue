<template>	
	<div class="col-md-3 left_col">
	  <div class="left_col scroll-view">
	      <div class="navbar nav_title" style="border: 0;">
	        <a href="/admin" class="site_title"><i class="fa fa-paw"></i> <span><span style="color:red;">Holi</span>dayPlanner</span></a>
	      </div>

	      <div class="clearfix"></div>

	      <!-- menu profile quick info -->
	      <div class="profile clearfix">
	          <div class="profile_pic">
	            <img src="{{ asset('images/profiles/akas.jpg') }}" alt="..." class="img-circle profile_img">
	          </div>
	          <div class="profile_info">
	            <span>Welcome,</span>
	            <h2>{{ Auth::user()->fname }}</h2>
	          </div>
	      </div>
	      <!-- /menu profile quick info -->

	       <br />

	      <!-- sidebar menu -->
	      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	        <div class="menu_section">
	          <h3>General</h3>
	          <ul class="nav side-menu">
	            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
	              <ul class="nav child_menu">
	                <li><a href="index.html">Dashboard</a></li>
	                <li><a href="index2.html">Dashboard2</a></li>
	                <li><a href="index3.html">Dashboard3</a></li>
	              </ul>
	            </li>
	            <li><a><i class="fa fa-edit"></i> Posts <span class="fa fa-chevron-down"></span></a>
	              <ul class="nav child_menu">
	                <li><a href="/admin/posts">Regular Posts</a></li>
	                <li><a href="/admin/posts/create">Create Post</a></li>
	                
	              </ul>
	            </li>

	            
	            <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
	              <ul class="nav child_menu">
	                <li><a href="/admin/register">Add User</a></li>
	                <li><a href="/admin/userlist">Users</a></li>
	              </ul>
	            </li>
	           
	                                    
	            
	          </ul>
	        </div>
	        <div class="menu_section">
	          <h3>Live On</h3>
	          <ul class="nav side-menu">
	            <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
	              <ul class="nav child_menu">
	                <li><a href="e_commerce.html">E-commerce</a></li>
	                <li><a href="projects.html">Projects</a></li>
	                <li><a href="project_detail.html">Project Detail</a></li>
	                <li><a href="contacts.html">Contacts</a></li>
	                <li><a href="profile.html">Profile</a></li>
	              </ul>
	            </li>
	            
	                             
	            <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Notification <span class="label label-danger pull-right">10</span></a></li>
	          </ul>
	        </div>

	      </div>
	    <!-- /sidebar menu -->

	    <!-- /menu footer buttons -->
	    <div class="sidebar-footer hidden-small">
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
	    </div>
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
	                        <img src="{{ asset('images/profiles/akas.jpg') }}" alt="">{{ Auth::user()->fname }}
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

	                  <li role="presentation" class="dropdown">
	                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
	                      <i class="fa fa-envelope-o"></i>
	                      <span class="badge bg-green">6</span>
	                    </a>
	                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
	                        <li>
	                            <a>
	                                <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}" alt="Profile Image" /></span>
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
	                                <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}" alt="Profile Image" /></span>
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
	                                <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}" alt="Profile Image" /></span>
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
	                                  <span class="image"><img src="{{ asset('images/profiles/akas.jpg') }}" alt="Profile Image" /></span>
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
	                </li>
	            </ul>
	        </nav>
	    </div>
	</div>
	<!-- /top navigation -->

</template>