<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>KUPPON - Admin Panel</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    @stack('css')


</head>
<body onload="startTime()">
<!-- loader starts-->
<div class="loader-wrapper">
    <div class="loader-index"><span></span></div>
    <svg>
        <defs></defs>
        <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></fecolormatrix>
        </filter>
    </svg>
</div>
<!-- loader ends-->
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper null compact-wrapper " id="pageWrapper" style="background-color: white;">
    <!-- Page Header Start-->
    <div class="page-header close_icon">
        <div class="header-wrapper row m-0 float-left">
            <form class="form-inline search-full col" action="#" method="get">
                <div class="form-group w-100">
                    <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                   placeholder="Search Cuba .." name="q" title="" autofocus>
                            <div class="spinner-border Typeahead-spinner" role="status"><span
                                        class="sr-only">Loading...</span></div>
                            <i class="close-search" data-feather="x"></i>
                        </div>
                        <div class="Typeahead-menu"></div>
                    </div>
                </div>
            </form>
            <div class="header-logo-wrapper col-auto p-0">
                <div class="logo-wrapper"><a href="/"><img class="img-fluid"
                                                                    src="../assets/images/logo/logo.png" alt=""></a>
                </div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                                               data-feather="align-center"></i></div>
            </div>
            <div class="left-header col horizontal-wrapper ps-0">
            </div>
            <div class="nav-right col-8 pull-right right-header p-0">
                <ul class="nav-menus">
                    <li><span class="header-search"><i data-feather="search"></i></span></li>


                    <li>
                        <div class="mode"><i class="fa fa-moon-o"></i></div>
                    </li>

                    <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    data-feather="maximize"></i></a></li>
                    <li class="profile-nav onhover-dropdown p-0 me-0">
                        <div class="media profile-media"><img class="b-r-10"
                                                              src="../assets/images/dashboard/profile.jpg" alt="">
                            <div class="media-body"><span>{{Auth::user()->name}}</span>
                                <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div">
                            <li><a href="#"><i data-feather="user"></i><span>Hesabım </span></a></li>
                            <li><a href="{{route('logout')}}"><i data-feather="log-in"> </i><span>Çıkış Yap</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <script class="result-template" type="text/x-handlebars-template">
                <div class="ProfileCard u-cf">
                    <div class="ProfileCard-avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-airplay m-0">
                            <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                            <polygon points="12 15 17 21 7 21 12 15"></polygon>
                        </svg>
                    </div>
                    <div class="ProfileCard-details">
                        <div class="ProfileCard-realName"></div>
                    </div>
                </div>
            </script>
            <script class="empty-template" type="text/x-handlebars-template">
                <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down,
                    yikes!
                </div></script>
        </div>
    </div>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper close_icon">
            <div>
                <div class="logo-wrapper"><a href="/">
                        <h3>Kuppon</h3></a>
                    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                    </div>
                </div>
                <div class="logo-icon-wrapper"><a href="/"><img class="img-fluid"
                                                                         src="../assets/images/logo/logo-icon.png"
                                                                         alt=""></a></div>
                <nav class="sidebar-main">
                    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                    <div id="sidebar-menu">
                        <ul class="sidebar-links" id="simple-bar">
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                            data-feather="airplay"></i><span class="home">Widgets</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="general-widget.html">General</a></li>
                                    <li><a href="chart-widget.html">Chart</a></li>
                                </ul>
                            </li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                                        href="{{route('index')}}"><i
                                            data-feather="home"> </i><span>Dashboard</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                                        href="{{route('match')}}"><i
                                        data-feather="aperture"> </i><span>Bülten</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                                        href="{{route('match_daily')}}"><i
                                        data-feather="aperture"> </i><span>Günlük Maçlar</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                                        href="{{route('match_live')}}"><i
                                        data-feather="aperture"> </i><span>Canlı Maçlar</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav"
                                                        href="{{route('contact')}}"><i
                                        data-feather="aperture"> </i><span>İletişim</span></a></li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title"
                                   href="#"><i
                                        data-feather="bell"></i><span
                                    >Bildirimler             </span></a>
                                <ul class="sidebar-submenu">
                                    <li><a  href="{{route('push_list')}}">Bildirimler</a></li>
                                    <li><a  href="{{route('push_create')}}">Bildirim Oluştur</a></li>
                                </ul>
                            </li>

                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title"
                                   href="#"><i
                                            data-feather="box"></i><span
                                            >Kuponlar             </span></a>
                                <ul class="sidebar-submenu">
                                    <li><a  href="{{route('coupon_list')}}">Kuponlar</a></li>
                                    <li><a  href="{{route('coupon_priv_list')}}">Özel Kuponlar</a></li>
                                    <li><a  href="{{route('coupon_priv_buy')}}">Satın Alınan Kuponlar</a></li>
                                </ul>
                            </li>

                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title"
                                   href="#"><i
                                            data-feather="user"></i><span
                                    >Kullanıcılar             </span></a>
                                <ul class="sidebar-submenu">
                                    <li><a  href="{{route('user_list')}}">Kullanıcılar</a></li>
                                    <li><a  href="{{route('user_premium_list')}}">Premium Kullanıcılar</a></li>
                                    <li><a  href="{{route('user_create')}}">Kullanıcı Oluştur</a></li>
                                </ul>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title"
                                   href="#"><i
                                        data-feather="settings"></i><span
                                    >Ayarlar             </span></a>
                                <ul class="sidebar-submenu">
                                    <li><a  href="{{route('settings')}}">Genel Ayarlar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                </nav>
            </div>
        </div>
