<?php
    include 'connect.php';
    
    $select = "SELECT * FROM jenisStatistik WHERE status='enable' ORDER BY susunan ASC";
    $list_statistics = mysqli_fetch_all(mysqli_query($conn2,$select),MYSQLI_ASSOC);
    $list_name = array_column($list_statistics,'namaStatistik');
    $list_label = array_column($list_statistics,'labelStatistik');





?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard." name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>

		<!-- Title -->
		<title>Dayone - Multipurpose Admin & Dashboard Template</title>

		<!--Favicon -->
		<link rel="icon" href="../../assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="../../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="../../assets/css/style.css" rel="stylesheet" />
		<link href="../../assets/css/dark.css" rel="stylesheet" />
		<link href="../../assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="../../assets/css/animated.css" rel="stylesheet" />

		<!--Sidemenu css -->
        <link  href="../../assets/css/sidemenu.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="../../assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="../../assets/css/icons.css" rel="stylesheet" />

		<!---Sidebar css-->
		<link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="../../assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="../../assets/plugins/datatable/datatables.min.css" rel="stylesheet" />
		<link href="../../assets/plugins/datatable/css/jquery.dataTables.min.css" rel="stylesheet" />
		<link href="../../assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="../../assets/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

		<!-- INTERNAL Pg-calendar-master css -->
		<link href="../../assets/plugins/pg-calendar-master/pignose.calendar.css" rel="stylesheet" />
		
		<!-- INTERNAL Mutipleselect css-->
		<link rel="stylesheet" href="../../assets/plugins/multipleselect/multiple-select.css">

		<!-- INTERNAL Sumoselect css-->
		<link rel="stylesheet" href="../../assets/plugins/sumoselect/sumoselect.css">

		<!-- INTERNAL Jquerytransfer css-->
		<link rel="stylesheet" href="../../assets/plugins/jQuerytransfer/jquery.transfer.css">
		<link rel="stylesheet" href="../../assets/plugins/jQuerytransfer/icon_font/icon_font.css">

	</head>

	<body class="app sidebar-mini">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="../../assets/images/svgs/loader.svg" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">

				<!--aside open-->
				<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="index.html">
							<img src="../../assets/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Dayonelogo">
							<img src="../../assets/images/brand/logo-white.png" class="header-brand-img dark-logo" alt="Dayonelogo">
							<img src="../../assets/images/brand/favicon.png" class="header-brand-img mobile-logo" alt="Dayonelogo">
							<img src="../../assets/images/brand/favicon1.png" class="header-brand-img darkmobile-logo" alt="Dayonelogo">
						</a>
					</div>
					<div class="app-sidebar3">
						<div class="app-sidebar__user">
							<div class="dropdown user-pro-body text-center">
								<div class="user-pic">
									<img src="../../assets/images/users/16.jpg" alt="user-img" class="avatar-xxl rounded-circle mb-1">
								</div>
								<div class="user-info">
									<h5 class=" mb-2">Abigali kelly</h5>
									<span class="text-muted app-sidebar__user-name text-sm">App Developer</span>
								</div>
							</div>
						</div>
						<ul class="side-menu">
							<li class="side-item side-item-category mt-4">Dashboards</li>
							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
									<i class="feather feather-home sidemenu_icon"></i>
									<span class="side-menu__label">HR Dashboard</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">
									<li><a href="index.html" class="slide-item">Dashboard</a></li>
									<li><a href="hr-department.html" class="slide-item">Department</a></li>
									<li class="sub-slide">
										<a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Employees</span><i class="sub-angle fa fa-angle-right"></i></a>
										<ul class="sub-slide-menu">
											<li><a class="sub-slide-item" href="hr-emplist.html">Employees List</a></li>
											<li><a class="sub-slide-item" href="hr-empview.html">View Employee</a></li>
											<li><a class="sub-slide-item" href="hr-addemployee.html">Add Employee</a></li>
										</ul>
									</li>
									<li class="sub-slide">
										<a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Attendance</span><i class="sub-angle fa fa-angle-right"></i></a>
										<ul class="sub-slide-menu">
											<li><a class="sub-slide-item" href="hr-attlist.html">Attendance List</a></li>
											<li><a class="sub-slide-item" href="hr-attuser.html">Attendance By User</a></li>
											<li><a class="sub-slide-item" href="hr-attview.html">Attendance View</a></li>
											<li><a class="sub-slide-item" href="hr-overviewcldr.html">Overview Calender</a></li>
											<li><a class="sub-slide-item" href="hr-attmark.html">Attendance Mark </a></li>
											<li><a class="sub-slide-item" href="hr-leaves.html">Leave Settings</a></li>
											<li><a class="sub-slide-item" href="hr-leavesapplication.html">Leave Applications</a></li>
											<li><a class="sub-slide-item" href="hr-recentleaves.html">Recent Leaves </a></li>
										</ul>
									</li>
									<li><a href="hr-award.html" class="slide-item">Awards</a></li>
									<li><a href="hr-holiday.html" class="slide-item">Holidays</a></li>
									<li><a href="hr-notice.html" class="slide-item">Notice Board</a></li>
									<li><a href="hr-expenses.html" class="slide-item">Expenses</a></li>
									<li class="sub-slide">
										<a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Payroll</span><i class="sub-angle fa fa-angle-right"></i></a>
										<ul class="sub-slide-menu">
											<li><a class="sub-slide-item" href="hr-empsalary.html">Employee Salary</a></li>
											<li><a class="sub-slide-item" href="hr-addpayroll.html">Add Payroll</a></li>
											<li><a class="sub-slide-item" href="hr-editpayroll.html">Edit Payroll</a></li>
										</ul>
									</li>
									<li><a href="hr-events.html" class="slide-item">Events</a></li>
									<li><a href="hr-settings.html" class="slide-item">Settings</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</aside>
				<!--aside closed-->

				<div class="app-content main-content">
					<div class="side-app">

						<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.html">
										<img src="../../assets/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Dayonelogo">
										<img src="../../assets/images/brand/logo-white.png" class="header-brand-img dark-logo" alt="Dayonelogo">
										<img src="../../assets/images/brand/favicon.png" class="header-brand-img mobile-logo" alt="Dayonelogo">
										<img src="../../assets/images/brand/favicon1.png" class="header-brand-img darkmobile-logo" alt="Dayonelogo">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
									<div class="mt-0">
										<form class="form-inline">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" >
													<i class="feather feather-search"></i>
												</button>
											</div>
										</form>
									</div><!-- SEARCH -->
									<div class="d-flex order-lg-2 my-auto ml-auto">
										<a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#" data-toggle="search">
											<i class="feather feather-search search-icon header-icon"></i>
										</a>
										<div class="dropdown header-flags">
											<a class="nav-link icon" data-toggle="dropdown">
												<img src="../../assets/images/flags/flag-png/united-kingdom.png" class="h-24" alt="img">
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
												<a href="#" class="dropdown-item d-flex "> <span class="avatar  mr-3 align-self-center bg-transparent"><img src="../../assets/images/flags/flag-png/india.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">India</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar  mr-3 align-self-center bg-transparent"><img src="../../assets/images/flags/flag-png/united-kingdom.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">UK</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar mr-3 align-self-center bg-transparent"><img src="../../assets/images/flags/flag-png/italy.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">Italy</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar mr-3 align-self-center bg-transparent"><img src="../../assets/images/flags/flag-png/united-states-of-america.png" class="h-24" alt="img"></span>
													<div class="d-flex"> <span class="my-auto">US</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar  mr-3 align-self-center bg-transparent"><img src="../../assets/images/flags/flag-png/spain.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">Spain</span> </div>
												</a>
											</div>
										</div>
										<div class="dropdown header-fullscreen">
											<a class="nav-link icon full-screen-link">
												<i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
												<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
											</a>
										</div>
										<div class="dropdown header-message">
											<a class="nav-link icon" data-toggle="dropdown">
												<i class="feather feather-mail header-icon"></i>
												<span class="badge badge-success side-badge">5</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated">
												<div class="header-dropdown-list message-menu" id="message-menu">
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="../../assets/images/users/1.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Jack Wright</h6>
																	<p class="fs-13 mb-1">All the best your template awesome</p>
																	<div class="small text-muted">
																		3 hours ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="../../assets/images/users/2.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Lisa Rutherford</h6>
																	<p class="fs-13 mb-1">Hey! there I'm available</p>
																	<div class="small text-muted">
																		5 hour ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="../../assets/images/users/3.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Blake Walker</h6>
																	<p class="fs-13 mb-1">Just created a new blog post</p>
																	<div class="small text-muted">
																		45 mintues ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="../../assets/images/users/4.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Fiona Morrison</h6>
																	<p class="fs-13 mb-1">Added new comment on your photo</p>
																	<div class="small text-muted">
																		2 days ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="../../assets/images/users/6.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Stewart Bond</h6>
																	<p class="fs-13 mb-1">Your payment invoice is generated</p>
																	<div class="small text-muted">
																		3 days ago
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
												<div class=" text-center p-2">
													<a href="#" class="">See All Messages</a>
												</div>
											</div>
										</div>
										<div class="dropdown header-notify">
											<a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
												<i class="feather feather-bell header-icon"></i>
												<span class="bg-dot"></span>
											</a>
										</div>
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
												<span>
													<img src="../../assets/images/users/16.jpg" alt="img" class="avatar avatar-md bradius">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
												<div class="p-3 text-center border-bottom">
													<a href="#" class="text-center user pb-0 font-weight-bold">John Thomson</a>
													<p class="text-center user-semi-title">App Developer</p>
												</div>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-user mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Profile</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-settings mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Settings</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-mail mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Messages</div>
												</a>
												<a class="dropdown-item d-flex" href="#" data-toggle="modal" data-target="#changepasswordnmodal">
													<i class="feather feather-edit-2 mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Change Password</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-power mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Sign Out</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->

						<!--Page header-->
						<div class="page-header d-xl-flex d-block">
							<div class="page-leftheader">
								<h4 class="page-title">Client<span class="font-weight-normal text-muted ml-2">Dashboard</span></h4>
							</div>
							<div class="page-rightheader ml-md-auto">
								<div class="d-flex align-items-end flex-wrap my-auto right-content breadcrumb-right">
									<div class="btn-list">
										<button  class="btn btn-primary " data-toggle="modal" data-target="#newprojectmodal"><i class="feather feather-plus fs-15 my-auto mr-2"></i>Create New Project</button>
										<button  class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i class="feather feather-mail"></i> </button>
										<button  class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i class="feather feather-phone-call"></i> </button>
										<button  class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i class="feather feather-info"></i> </button>
									</div>
								</div>
							</div>
						</div>
						<!--End Page header-->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-9">
														<div class="mt-0 text-left">
															<span class="fs-16 font-weight-semibold">Total Projects</span>
															<h3 class="mb-0 mt-1 text-primary fs-25">12,548</h3>
														</div>
													</div>
													<div class="col-3">
														<div class="icon1 bg-primary-transparent my-auto  float-right"> <i class="feather feather-briefcase"></i> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-9">
														<div class="mt-0 text-left">
															<span class="fs-16 font-weight-semibold">On Going</span>
															<h3 class="mb-0 mt-1 text-secondary fs-25">94</h3>
														</div>
													</div>
													<div class="col-3">
														<div class="icon1 bg-secondary-transparent my-auto  float-right"> <i class="feather feather-info"></i> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-9">
														<div class="mt-0 text-left">
															<span class="fs-16 font-weight-semibold">Completed Projects</span>
															<h3 class="mb-0 mt-1 text-success fs-25">11,134</h3>
														</div>
													</div>
													<div class="col-3">
														<div class="icon1 bg-success-transparent my-auto  float-right"> <i class="feather feather-check"></i> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card">
											<div class="card-header  border-0">
												<h4 class="card-title">Statistik </h4>
											</div>
											<div class="card-body">
												<div id="single-chart" class="mx-auto apex-dount"></div>
												<div class="row">
													<div class="col-10 mx-auto">
														<table class="table mb-0">
															<tbody>
																<tr>
																	<td class="p-2 d-flex"><span class="dot-label bg-primary mr-2 mt-1"></span><span class="font-weight-normal"> Design</span></td>
																	<td class="p-2"><span class="mr-4 fs-16">:</span><span class="ml-auto font-weight-semibold fs-16">$953</span></td>
																</tr>
																<tr>
																	<td class="p-2 d-flex"><span class="dot-label bg-secondary mr-2 mt-1"></span> <span class="font-weight-normal">Development</span></td>
																	<td class="p-2"><span class="mr-4 fs-16">:</span><span class="ml-auto font-weight-semibold fs-16">$12,426</span></td>
																</tr>
																<tr>
																	<td class="p-2 d-flex"><span class="dot-label bg-success mr-2 mt-1 "></span> <span class="font-weight-normal">Service</span></td>
																	<td class="p-2"><span class="mr-4 fs-16">:</span><span class="ml-auto font-weight-semibold fs-16">$25,453</span></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

					</div>
				</div><!-- end app-content-->
			</div>

			<!--Footer-->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							<!--Copyright © 2021 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.-->
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->

		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

		<!-- Jquery js-->
		<script src="../../assets/plugins/jquery/jquery.min.js"></script>

		<!--Moment js-->
		<script src="../../assets/plugins/moment/moment.js"></script>

		<!-- Bootstrap4 js-->
		<script src="../../assets/plugins/bootstrap/popper.min.js"></script>
		<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="../../assets/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!--Sidemenu js-->
		<script src="../../assets/plugins/sidemenu/sidemenu.js"></script>

		<!-- P-scroll js-->
		<script src="../../assets/plugins/p-scrollbar/p-scrollbar.js"></script>
		<script src="../../assets/plugins/p-scrollbar/p-scroll1.js"></script>

		<!--Sidebar js-->
		<script src="../../assets/plugins/sidebar/sidebar.js"></script>

		<!-- Select2 js -->
		<script src="../../assets/plugins/select2/select2.full.min.js"></script>

		<!-- Circle-progress js-->
		<script src="../../assets/plugins/circle-progress/circle-progress.min.js"></script>

		<!-- INTERNAL Chart js -->
		<script src="../../assets/plugins/chart/chart.bundle.js"></script>
		<script src="../../assets/plugins/chart/utils.js"></script>

		<!-- INTERNAL Chartjs rounded-barchart -->
		<script src="../../assets/plugins/chart.min/chart.min.js"></script>
		<script src="../../assets/plugins/chart.min/rounded-barchart.js"></script>

		<!-- INTERNAL Apexchart js-->
		<script src="../../assets/plugins/apexchart/apexcharts.js"></script>
		
		<!-- INTERNAL jquery transfer js-->
		<script src="../../assets/plugins/jQuerytransfer/jquery.transfer.js"></script>
		
		<!-- INTERNAL Multiple select js -->
		<script src="../../assets/plugins/multipleselect/multiple-select.js"></script>
		<script src="../../assets/plugins/multipleselect/multi-select.js"></script>

		<!-- INTERNAL Sumoselect js-->
		<script src="../../assets/plugins/sumoselect/jquery.sumoselect.js"></script>

		<!-- INTERNAL Data tables -->
		<script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="../../assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
		<script src="../../assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="../../assets/plugins/datatable/responsive.bootstrap4.min.js"></script>

		<!-- INTERNAL Pg-calendar-master js -->
		<script src="../../assets/plugins/pg-calendar-master/pignose.calendar.full.min.js"></script>

		<!-- INTERNAL Index js-->
		<!--<script src="../../assets/js/index5.js"></script>-->
		<!--<script src="../../assets/js/client/client-sidemenuchart.js"></script>-->
		
		<!-- INTERNAL Form Advanced Element -->
		<script src="../../assets/js/formelementadvnced.js"></script>
		<!--<script src="../../assets/js/form-elements.js"></script>-->
		<script src="../../assets/js/file-upload.js"></script>

		<!-- Custom js-->
		<script src="../../assets/js/custom.js"></script>
		
		
		
		

	</body>
</html>