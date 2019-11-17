<body>
    <div id="sb-site">
	    <div id="loading">
	        <div class="spinner">
	            <div class="bounce1"></div>
	            <div class="bounce2"></div>
	            <div class="bounce3"></div>
	        </div>
	    </div>
	    <div id="page-wrapper">
	    	<div id="page-header" class="bg-gradient-9">
	    		<div id="mobile-navigation">
			        <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
			        <a href="index.html" class="logo-content-small" title="MonarchUI"></a>
			    </div>
			    <div id="header-logo" class="logo-bg">
			        <a href="index.html" class="logo-content-big" title="MonarchUI">
			            Monarch <i>UI</i>
			            <span>The perfect solution for user interfaces</span>
			        </a>
			        <a href="index.html" class="logo-content-small" title="MonarchUI">
			            Monarch <i>UI</i>
			            <span>The perfect solution for user interfaces</span>
			        </a>
			        <a id="close-sidebar" href="#" title="Close sidebar">
			            <i class="glyph-icon icon-angle-left"></i>
			        </a>
			    </div>
			    <div id="header-nav-left">
			        <div class="user-account-btn dropdown">
			            <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
			                <img width="28" src="<?php echo base_url('assets/image-resources/gravatar.jpg')?>" alt="Profile image">
			                <span>Cool Admin</span>
			                <i class="glyph-icon icon-angle-down"></i>
			            </a>
			            <div class="dropdown-menu float-left">
			                <div class="box-sm">
			                    <div class="login-box clearfix">
			                        <div class="user-img">
			                            <a href="#" title="" class="change-img">Change photo</a>
			                            <img src="<?php echo base_url('assets/image-resources/gravatar.jpg')?>" alt="">
			                        </div>
			                        <div class="user-info">
			                            <span>
			                                Cool Admin
			                                <i>UX/UI developer</i>
			                            </span>
			                            <a href="#" title="Edit profile">Edit profile</a>
			                            <a href="#" title="View notifications">View notifications</a>
			                        </div>
			                    </div>
			                    <div class="divider"></div>
			                    <ul class="reset-ul mrg5B">
			                        <li>
			                            <a href="#">
			                                View login page example
			                                <i class="glyph-icon float-right icon-caret-right"></i>
			                            </a>
			                        </li>
			                        <li>
			                            <a href="#">
			                                View lockscreen example
			                                <i class="glyph-icon float-right icon-caret-right"></i>
			                            </a>
			                        </li>
			                        <li>
			                            <a href="#">
			                                View account details
			                                <i class="glyph-icon float-right icon-caret-right"></i>
			                            </a>
			                        </li>
			                    </ul>
			                    <div class="pad5A button-pane button-pane-alt text-center">
			                        <a href="#" class="btn display-block font-normal btn-danger">
			                            <i class="glyph-icon icon-power-off"></i>
			                            Logout
			                        </a>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div><!-- #header-nav-left -->
			    <div id="header-nav-right">
			        <a href="#" class="hdr-btn" id="fullscreen-btn" title="Fullscreen">
			            <i class="glyph-icon icon-arrows-alt"></i>
			        </a>
			    </div><!-- #header-nav-right -->
			</div>
			<div id="page-sidebar">
				<div class="scroll-sidebar">
					<ul id="sidebar-menu">
						<li class="header"><span>Module</span></li>
					    <li>
					        <a href="<?php echo base_url('backend/Backend_user')?>" title="User">
					            <i class="glyph-icon icon-linecons-tv"></i>
					            <span>User</span>
					        </a>
					    </li>
					    <li>
					        <a href="<?php echo base_url('backend/Backend_artikel')?>" title="Artikel">
					            <i class="glyph-icon icon-linecons-tv"></i>
					            <span>Artikel</span>
					        </a>
					    </li>
					    <li>
					        <a href="<?php echo base_url('backend/Backend_imagegaleri')?>" title="Image Galeri">
					            <i class="glyph-icon icon-linecons-tv"></i>
					            <span>Image Galeri</span>
					        </a>
					    </li>
					    <li>
					        <a href="<?php echo base_url('backend/Backend_menu')?>" title="Menu">
					            <i class="glyph-icon icon-linecons-tv"></i>
					            <span>Menu</span>
					        </a>
					    </li>
					    <li>
					        <a href="<?php echo base_url('backend/Backend_slide')?>" title="Slide">
					            <i class="glyph-icon icon-linecons-tv"></i>
					            <span>Slide</span>
					        </a>
					    </li>
					    <li>
					        <a href="<?php echo base_url('backend/Backend_submenu')?>" title="Submenu">
					            <i class="glyph-icon icon-linecons-tv"></i>
					            <span>Submenu</span>
					        </a>
					    </li>
					    <li>
					        <a href="<?php echo base_url('backend/Backend_videogaleri')?>" title="Video Galeri">
					            <i class="glyph-icon icon-linecons-tv"></i>
					            <span>Video Galeri</span>
					        </a>
					    </li>
					</ul>
				</div>
			</div>
			<div id="page-content-wrapper">
				<div id="page-content">
					<?php echo $page_content; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap Dropdown -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/dropdown/dropdown.js')?>"></script>
	<!-- Bootstrap Tooltip -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/tooltip/tooltip.js')?>"></script>
	<!-- Bootstrap Popover -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/popover/popover.js')?>"></script>
	<!-- Bootstrap Progress Bar -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/progressbar/progressbar.js')?>"></script>
	<!-- Bootstrap Buttons -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/button/button.js')?>"></script>
	<!-- Bootstrap Collapse -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/collapse/collapse.js')?>"></script>
	<!-- Superclick -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/superclick/superclick.js')?>"></script>
	<!-- Input switch alternate -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/input-switch/inputswitch-alt.js')?>"></script>
	<!-- Slim scroll -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/slimscroll/slimscroll.js')?>"></script>
	<!-- Slidebars -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/slidebars/slidebars.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/slidebars/slidebars-demo.js')?>"></script>
	<!-- PieGage -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/charts/piegage/piegage.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/charts/piegage/piegage-demo.js')?>"></script>
	<!-- Screenfull -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/screenfull/screenfull.js')?>"></script>
	<!-- Content box -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/content-box/contentbox.js')?>"></script>
	<!-- Overlay -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/overlay/overlay.js')?>"></script>
	<!-- Widgets init for demo -->
	<script type="text/javascript" src="<?php echo base_url('assets/js-init/widgets-init.js')?>"></script>
	<!-- Theme layout -->
	<script type="text/javascript" src="<?php echo base_url('assets/themes/admin/layout.js')?>"></script>
	<!-- Theme switcher -->
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/theme-switcher/themeswitcher.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/datatable/datatable.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/datatable/datatable-bootstrap.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/datatable/datatable-responsive.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/modal/modal.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/jgrowl-notifications/jgrowl.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/jgrowl-notifications/jgrowl-demo.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/widgets/parsley/parsley.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js-init/custom-init.js')?>"></script>
</body>