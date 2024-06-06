<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
				<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">

				<meta http-equiv="Cache-control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta name="asset-url" content="{{ asset('') }}">

        <title>WAN | @yield('title')</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">
		
		<!-- Sweet-Alert JS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/sweet-alert/sweetalert2.min.css')}}">

		<!-- Select2 CSS -->
				<link rel="stylesheet" href="{{asset("assets/css/select2.min.css")}}">
		
		<!-- Datatable CSS -->
				<link rel="stylesheet" href="{{asset("assets/css/dataTables.bootstrap4.min.css")}}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
		
		<!-- Other CSS -->
		@yield('css')
		
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
			<script>
				var csrfToken = "{{ csrf_token() }}";
				var serviceBase = "{{url('/') . '/'}}";
			</script>
    </head>
    <body>
		<!-- Main Wrapper -->
		<div class="main-wrapper">

			
			<!-- Loader -->
			<div id="loader-wrapper" style="display: none">
				<div id="loader">
					<div class="loader-ellips">
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					</div>
				</div>
			</div>
			<!-- /Loader -->

			<!-- Header -->
			<div class="header">
			
				<!-- Logo -->
				<div class="header-left">
					<a href="{{route('home')}}" class="logo">
						<img src="{{asset('assets/img/logo.png')}}" width="40" height="40" alt="">
					</a>
				</div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
				<div class="page-title-box">
					<h3>Wanzoou Timer</h3>
				</div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					<li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<!-- /Search -->
				
					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
							<img src="{{asset('assets/img/flags/us.png')}}" alt="" height="20"> <span>English</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{asset('assets/img/flags/us.png')}}" alt="" height="16"> English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{asset('assets/img/flags/fr.png')}}" alt="" height="16"> French
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{asset('assets/img/flags/es.png')}}" alt="" height="16"> Spanish
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="{{asset('assets/img/flags/de.png')}}" alt="" height="16"> German
							</a>
						</div>
					</li>
					<!-- /Flag -->
				
					<!-- Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="{{asset('assets/img/profiles/avatar-02.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
								@if(Auth::user()->avatar != '' || Auth::user()->avatar != null)
									<img src="{{asset('assets/img/profiles/avatar-21.jpg')}}" alt="{{Auth::user()->first_name}} {{Auth::user()->last_name}}">
								@else
									<img src="{{asset('assets/img/default/default_profile.png')}}" alt="{{Auth::user()->first_name}} {{Auth::user()->last_name}}">
								@endif
								<span class="status online"></span>
							</span>
							<span>{{Auth::user()->username}}</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
							<a class="dropdown-item" href="settings.html">Settings</a>
							<a class="dropdown-item" href="{{route('logout')}}">Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="{{route('logout')}}">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
			</div>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="index.html">Admin Dashboard</a></li>
									<li><a href="employee-dashboard.html">Employee Dashboard</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-cube"></i> <span> Apps</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="chat.html">Chat</a></li>
									<li class="submenu">
										<a href="#"><span> Calls</span> <span class="menu-arrow"></span></a>
										<ul style="display: none;">
											<li><a href="voice-call.html">Voice Call</a></li>
											<li><a href="video-call.html">Video Call</a></li>
											<li><a href="outgoing-call.html">Outgoing Call</a></li>
											<li><a href="incoming-call.html">Incoming Call</a></li>
										</ul>
									</li>
									<li><a href="events.html">Calendar</a></li>
									<li><a href="contacts.html">Contacts</a></li>
									<li><a href="inbox.html">Email</a></li>
									<li><a href="file-manager.html">File Manager</a></li>
								</ul>
							</li>
							<li class="menu-title"> 
								<span>Employees</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('employeesCardList')}}">All Employees</a></li>
									<li><a href="holidays.html">Holidays</a></li>
									<li><a href="leaves.html">Leaves (Admin) <span class="badge badge-pill bg-primary float-right">1</span></a></li>
									<li><a href="leaves-employee.html">Leaves (Employee)</a></li>
									<li><a href="leave-settings.html">Leave Settings</a></li>
									<li><a href="attendance.html">Attendance (Admin)</a></li>
									<li><a href="attendance-employee.html">Attendance (Employee)</a></li>
									<li><a href="departments.html">Departments</a></li>
									<li><a href="designations.html">Designations</a></li>
									<li><a href="timesheet.html">Timesheet</a></li>
									<li><a href="shift-scheduling.html">Shift & Schedule</a></li>
									<li><a href="overtime.html">Overtime</a></li>
								</ul>
							</li>
							<li> 
								<a href="clients.html"><i class="la la-users"></i> <span>Clients</span></a>
							</li>
							<li class="menu-title"> 
								<span>Settings</span>
							</li>
							<li> 
								<a href="#"><i class="la la-file-text"></i> <span>Documentation</span></a>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-cog"></i> <span> Configuration</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('services.index')}}">Add Department</a></li>
									<li><a href="holidays.html">Holidays</a></li>
									<li><a href="departments.html">Departments</a></li>
									<li><a href="designations.html">Designations</a></li>
									<li><a href="timesheet.html">Timesheet</a></li>
									<li><a href="shift-scheduling.html">Shift & Schedule</a></li>
									<li><a href="overtime.html">Overtime</a></li>
								</ul>
							</li>
							<li> 
								<a href="javascript:void(0);"><i class="la la-info"></i> <span>Change Log</span> <span class="badge badge-primary ml-auto">v3.4</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
			
				<!-- Page Content -->
				<div class="content container-fluid">
					
					<!-- Content Starts -->
						@yield('content')
					<!-- /Content End -->
					
				</div>
				<!-- /Page Content -->
				
			</div>
			<!-- /Page Wrapper -->
			
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		
		<!-- Slimscroll JS -->
		<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
		
		<!-- Sweet-Alert JS -->
		<script src="{{asset('assets/plugins/sweet-alert/sweetalert2.min.js')}}"></script>

		<!-- Select2 JS -->
		<script src="{{asset('assets/js/select2.min.js')}}"></script>
		
		<!-- Datatable JS -->
		<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/app.js')}}"></script>

		<script>
			let timeout;
			function resetTimer() {
				clearTimeout(timeout);
				// timeout = setTimeout(() => { location.href = serviceBase + 'logout'; }, 900000); // Timeout après 15 minutes en millisecondes
			}
			// Réinitialiser le minuteur à chaque action de l'utilisateur
			document.addEventListener('mousemove', resetTimer);
			document.addEventListener('mousedown', resetTimer);
			document.addEventListener('keypress', resetTimer);
			document.addEventListener('touchmove', resetTimer);
			document.addEventListener('scroll', resetTimer);
			
			//Fonction Générique pour les messages du sweet alert
			let genericMessage = (messageJson) => {
				// console.log(messageJson);
				let messageText = "";
				// Vérifie si messageData est une chaîne de caractères
				if (typeof messageJson === "string") {
						messageText = messageJson;
				} else{
					$.each(messageJson, function (cle, valeur) {
						messageText += "<strong>" + cle + " :</strong> " + valeur + "<br>";
					});
				}
				return messageText;
			};
		
		</script>

		@yield('scripts')
		
    </body>
</html>