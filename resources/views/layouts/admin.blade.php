<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Latvian Stories | Admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Chicle&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&family=Literata:opsz,wght@7..72,400;7..72,500&family=Oranienbaum&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_admin.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link chevron" data-widget="pushmenu" href="#"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                            fill="none">
                            <path d="M7 12L11 8L7 4" stroke="#808080" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7187 13.3999L20.5187 15.2099C20.9809 15.6799 21.1168 16.3809 20.8638 16.9896C20.6107 17.5982 20.0178 17.9962 19.3587 17.9999H15.9987V18.3399C15.9014 20.4536 14.1126 22.0903 11.9987 21.9999C9.88467 22.0903 8.0959 20.4536 7.99865 18.3399V17.9999H4.63865C3.97949 17.9962 3.38659 17.5982 3.13353 16.9896C2.88047 16.3809 3.01641 15.6799 3.47865 15.2099L5.27865 13.3999V8.72993C5.28219 6.7911 6.12049 4.9477 7.57938 3.6707C9.03826 2.39369 10.9764 1.80679 12.8987 2.05993C16.2841 2.57882 18.7682 5.51528 18.7187 8.93993V13.3999ZM11.9987 19.9999C13.0021 20.0708 13.8834 19.3392 13.9987 18.3399V17.9999H9.99865V18.3399C10.1139 19.3392 10.9952 20.0708 11.9987 19.9999Z" fill="#637381" />
                        </svg>
                        <span class="badge badge-pill badge-danger navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block" style="display: none;">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> --}}
            </ul>
            {{-- <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name ?? 'Имя пользователя' }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Выйти') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            </li>
            </ul> --}}
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin" class="brand-link text-center">
                <span class="brand-text">LATVIAN <span class="brand-text-green">STORIES</span></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{-- <img src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                        class="img-circle elevation-2" alt="{{ __('User Image') }}"> --}}
                    </div>
                    <div class="info">
                        <span clsss="d-block">Hello, Admin</span>
                    </div>
                </div>
                <div class="form-inline castom_input">
                    <div class="input-group">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        {{-- <div class="input-group-append">
                            <button class="btn btn-sidebar">
                            </button>
                        </div> --}}
                        <div class="fa_search"></div>
                    </div>
                    <div class="sidebar-search-results">
                        <div class="list-group"><a href="#" class="list-group-item">
                                <div class="search-title"><strong class="text-light"></strong>N<strong
                                        class="text-light"></strong>o<strong class="text-light"></strong> <strong
                                        class="text-light"></strong>e<strong class="text-light"></strong>l<strong
                                        class="text-light"></strong>e<strong class="text-light"></strong>m<strong
                                        class="text-light"></strong>e<strong class="text-light"></strong>n<strong
                                        class="text-light"></strong>t<strong class="text-light"></strong> <strong
                                        class="text-light"></strong>f<strong class="text-light"></strong>o<strong
                                        class="text-light"></strong>u<strong class="text-light"></strong>n<strong
                                        class="text-light"></strong>d<strong class="text-light"></strong>!<strong
                                        class="text-light"></strong></div>
                                <div class="search-path"></div>
                            </a></div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('articles.index') }}"
                                class="nav-link {{ request()->is('admin/articles*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M21 5.48837V18.5116C21 20.4381 19.4501 22 17.5385 22H6.46154C4.54983 22 3 20.4381 3 18.5116V5.48837C3 3.56184 4.54983 2 6.46154 2H17.5385C19.4501 2 21 3.56184 21 5.48837ZM16.6154 9.44186H7.38462C7.00246 9.44186 6.69231 9.75442 6.69231 10.1395C6.69231 10.5247 7.00246 10.8372 7.38462 10.8372H16.6154C16.9975 10.8372 17.3077 10.5247 17.3077 10.1395C17.3077 9.75442 16.9975 9.44186 16.6154 9.44186ZM16.6154 13.1628H7.38462C7.00246 13.1628 6.69231 13.4753 6.69231 13.8605C6.69231 14.2456 7.00246 14.5581 7.38462 14.5581H16.6154C16.9975 14.5581 17.3077 14.2456 17.3077 13.8605C17.3077 13.4753 16.9975 13.1628 16.6154 13.1628ZM12 5.72093H7.38462C7.00246 5.72093 6.69231 6.03349 6.69231 6.4186C6.69231 6.80372 7.00246 7.11628 7.38462 7.11628H12C12.3822 7.11628 12.6923 6.80372 12.6923 6.4186C12.6923 6.03349 12.3822 5.72093 12 5.72093ZM16.6154 16.8837H7.38462C7.00246 16.8837 6.69231 17.1963 6.69231 17.5814C6.69231 17.9665 7.00246 18.2791 7.38462 18.2791H16.6154C16.9975 18.2791 17.3077 17.9665 17.3077 17.5814C17.3077 17.1963 16.9975 16.8837 16.6154 16.8837Z"
                                        fill="{{ request()->is('admin/articles*') ? '#FFFFFF' : '#C2C7D0' }}" />
                                </svg>
                                <p>
                                    Articles
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('routes.index') }}"
                                class="nav-link {{ request()->is('admin/routes*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M19 15.18V7C19 4.79 17.21 3 15 3C12.79 3 11 4.79 11 7V17C11 18.1 10.1 19 9 19C7.9 19 7 18.1 7 17V8.82C8.16 8.4 9 7.3 9 6C9 4.34 7.66 3 6 3C4.34 3 3 4.34 3 6C3 7.3 3.84 8.4 5 8.82V17C5 19.21 6.79 21 9 21C11.21 21 13 19.21 13 17V7C13 5.9 13.9 5 15 5C16.1 5 17 5.9 17 7V15.18C16.334 15.4159 15.7729 15.8797 15.4157 16.4892C15.0584 17.0988 14.9281 17.815 15.0478 18.5113C15.1674 19.2077 15.5293 19.8393 16.0695 20.2947C16.6097 20.7501 17.2935 20.9999 18 21C19.66 21 21 19.66 21 18C21 16.7 20.16 15.6 19 15.18Z"
                                        fill="{{ request()->is('admin/routes*') ? '#FFFFFF' : '#C2C7D0' }}" />
                                </svg>
                                <p>
                                    Routes
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M6.01175 13.8561C6.01429 13.9069 6.00647 13.9577 5.98877 14.0054C5.97107 14.0531 5.94385 14.0967 5.90877 14.1335C5.87369 14.1704 5.83149 14.1997 5.78472 14.2197C5.73796 14.2397 5.68761 14.25 5.63675 14.2499H1.5005C1.33122 14.2502 1.16683 14.1931 1.03407 14.0881C0.901303 13.9831 0.807971 13.8363 0.769249 13.6715C0.745137 13.5587 0.746249 13.4419 0.772504 13.3296C0.798759 13.2173 0.849509 13.1122 0.921124 13.0218C1.58282 12.1443 2.46077 11.4533 3.46925 11.0165C3.02649 10.6128 2.68691 10.1089 2.47894 9.54696C2.27098 8.98505 2.20068 8.38149 2.27395 7.78682C2.34721 7.19216 2.5619 6.6237 2.90003 6.12907C3.23817 5.63444 3.6899 5.22803 4.2174 4.94388C4.7449 4.65973 5.33281 4.50612 5.93188 4.49591C6.53096 4.48569 7.12376 4.61918 7.66063 4.88518C8.19751 5.15118 8.66284 5.54195 9.01764 6.02477C9.37244 6.50758 9.60638 7.06839 9.69987 7.66021C9.71195 7.7398 9.69769 7.82115 9.65927 7.89189C9.62086 7.96262 9.56039 8.01888 9.48706 8.05209C8.4468 8.533 7.56581 9.30144 6.94803 10.2667C6.33026 11.232 6.00148 12.3539 6.0005 13.4999C6.0005 13.6199 6.0005 13.738 6.01175 13.8561ZM23.0742 13.0208C22.4141 12.1443 21.5381 11.4538 20.5317 11.0165C20.9745 10.6128 21.3141 10.1089 21.5221 9.54696C21.73 8.98505 21.8003 8.38149 21.727 7.78682C21.6538 7.19216 21.4391 6.6237 21.101 6.12907C20.7628 5.63444 20.3111 5.22803 19.7836 4.94388C19.2561 4.65973 18.6682 4.50612 18.0691 4.49591C17.47 4.48569 16.8772 4.61918 16.3404 4.88518C15.8035 5.15118 15.3382 5.54195 14.9834 6.02477C14.6286 6.50758 14.3946 7.06839 14.3011 7.66021C14.289 7.7398 14.3033 7.82115 14.3417 7.89189C14.3801 7.96262 14.4406 8.01888 14.5139 8.05209C15.5542 8.533 16.4352 9.30144 17.053 10.2667C17.6707 11.232 17.9995 12.3539 18.0005 13.4999C18.0005 13.6199 18.0005 13.738 17.9892 13.8561C17.9867 13.9069 17.9945 13.9577 18.0122 14.0054C18.0299 14.0531 18.0571 14.0967 18.0922 14.1335C18.1273 14.1704 18.1695 14.1997 18.2163 14.2197C18.263 14.2397 18.3134 14.25 18.3642 14.2499H22.5005C22.6698 14.2502 22.8342 14.1931 22.9669 14.0881C23.0997 13.9831 23.193 13.8363 23.2317 13.6715C23.256 13.5585 23.2549 13.4415 23.2285 13.329C23.202 13.2165 23.151 13.1112 23.0789 13.0208H23.0742ZM14.7305 17.069C15.4773 16.4971 16.026 15.7055 16.2997 14.8056C16.5734 13.9057 16.5582 12.9427 16.2563 12.0518C15.9543 11.161 15.3808 10.3872 14.6164 9.83912C13.852 9.29106 12.935 8.99632 11.9944 8.99632C11.0538 8.99632 10.1368 9.29106 9.3724 9.83912C8.60796 10.3872 8.03448 11.161 7.73254 12.0518C7.43061 12.9427 7.41541 13.9057 7.68909 14.8056C7.96276 15.7055 8.51154 16.4971 9.25831 17.069C7.93319 17.6431 6.82668 18.6264 6.10081 19.8749C6.03498 19.9889 6.00032 20.1183 6.00033 20.2499C6.00034 20.3816 6.03501 20.511 6.10085 20.625C6.1667 20.739 6.2614 20.8337 6.37544 20.8995C6.48948 20.9653 6.61883 20.9999 6.7505 20.9999H17.2505C17.3822 20.9999 17.5115 20.9653 17.6256 20.8995C17.7396 20.8337 17.8343 20.739 17.9001 20.625C17.966 20.511 18.0007 20.3816 18.0007 20.2499C18.0007 20.1183 17.966 19.9889 17.9002 19.8749C17.1728 18.6256 16.0642 17.6422 14.7371 17.069H14.7305Z"
                                        fill="{{ request()->is('admin/users*') ? '#FFFFFF' : '#C2C7D0' }}" />
                                </svg>
                                <p>
                                    Users
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('partners.index') }}"
                                class="nav-link {{ request()->is('admin/partners*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm95.8 32.6L272 480l-32-136l32-56h-96l32 56l-32 136l-47.8-191.4C56.9 292 0 350.3 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-72.1-56.9-130.4-128.2-133.8z"
                                        fill="{{ request()->is('admin/partners*') ? '#FFFFFF' : '#C2C7D0' }}" />
                                </svg>
                                <p>
                                    Partners
                                </p>
                            </a>

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                @if (session()->has('success'))
                    <div class="alert alert-success ml-auto" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="container-fluid">
                    <div class="row mb-2 align-items-center">
                        <div class="col">
                            @yield('content-header')
                        </div>
                        @yield('breadcrumbs')
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>


    </div>
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

</body>

</html>
