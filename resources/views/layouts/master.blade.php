<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('COMPANY_NAME') }}</title>
        <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
        <style>
            .sidebar-nav ul .sidebar-item .sidebar-link:hover, .sidebar-nav ul .sidebar-item.selected > .sidebar-link, .sidebar-nav ul .sidebar-item.selected > .sidebar-link.active, .sidebar-nav ul .sidebar-item > .sidebar-link.active{
                border-radius: var(--bs-border-radius-pill) !important;
            }
            .nominee-img{
                transition: all .3s ease-in-out 0s;
                cursor: pointer;
            }
            .nominee-img:hover{
                transform: scale(0.9);
            }
            .text-error{
                color: rgb(220, 53, 69);
            }
        </style>
        @stack('style')
    </head>

    <body class="bg-light">
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            @include('includes.header')
            <div class="body-wrapper">
                <header class="app-header">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <ul class="navbar-nav">
                            <li class="nav-item d-block d-xl-none">
                                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                    href="javascript:void(0)">
                                    <i class="ti ti-menu-2"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                    <i class="ti ti-bell-ringing"></i>
                                    <div class="notification bg-primary rounded-circle"></div>
                                </a>
                            </li>
                        </ul>
                        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                        <div class="message-body">
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 dropdown-item">
                                                <i class="ti ti-user fs-6"></i>
                                                <p class="mb-0 fs-3">My Profile</p>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 dropdown-item">
                                                <i class="ti ti-mail fs-6"></i>
                                                <p class="mb-0 fs-3">My Account</p>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 dropdown-item">
                                                <i class="ti ti-list-check fs-6"></i>
                                                <p class="mb-0 fs-3">My Task</p>
                                            </a>
                                            <a href="./authentication-login.html"
                                                class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <div class="container-fluid">
                    @yield('body')
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
			window.addEventListener('alert', event => {
                //console.log('event', event.detail[0]);
				const type = event.detail[0].type;
				const message = event.detail[0].message;
				const title = event.detail[0].title ?? '';
				const options = {
					'closeButton': true,
					'progressBar': true,
					'showDuration': '300',
					'hideDuration': '5000',
					'timeOut': '5000',
				};
				switch(type){
					case 'success':
						toastr.success(message, title ?? '', options);
						break;
					case 'warning':
						toastr.warning(message, title ?? '', options);
						break;
					case 'error':
						toastr.error(message, title ?? '', options);
						break;
					case 'info':
						toastr.info(message, title ?? '', options);
						break;
					default:
						toastr.info(message, title ?? '', options);
				};
			});
		</script>
        @stack('script')
    </body>

</html>
