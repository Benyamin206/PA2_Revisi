<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('style/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('style/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('style/vendors/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/css/style.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <aside id="left-panel" class="left-panel" style="background-color: #028391; color: black">
        <nav class="navbar navbar-expand-sm navbar-default" style="background-color: #028391">
            <div class="navbar-header" style="background-color: #028391">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/home"><img src="{{ asset('style2/img/logoe-removebg-preview.png') }}" width="100" alt="Logo"><span style="color: white">AjibataTomok</span></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/home" style="color: white"> <i class="menu-icon fa fa-dashboard"></i><span style="color: white">Dashboard</span> </a>
                    </li>
                    <h3 class="menu-title" style="color: white">Kapal</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-ship"></i>Pemilik kapal</a>
                        <ul style="background-color: #028391" class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('index_pemilik_kapal')}}">Index</a></li>
                            <li><i class="fa fa-user-plus"></i><a href="{{route('tambah_pemilik_kapal')}}">Tambah Akun Pemilik Kapal</a></li>
                            <li><i class="menu-icon fa fa-ship"></i><a href="{{route('kapal.non-izin')}}">Perizinan Tambah Kapal</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-anchor"></i>Nahkoda</a>
                        <ul style="background-color: #028391" class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('index_supir')}}">Index</a></li>
                            <li><i class="fa fa-user-plus"></i><a href="/tambah_supir">Tambah Nahkoda</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cube"></i>Muatan</a>
                        <ul style="background-color: #028391" class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list"></i><a href="{{route('index_muatan')}}">Index</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('tambah_muatan')}}">Tambah Muatan</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Kelola Jadwal</h3>
                    <li>
                        <a href="{{route('index_rute')}}"> <i class="menu-icon fa fa-road"></i>Rute </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-calendar"></i>Jadwal</a>
                        <ul class="sub-menu children dropdown-menu" style="background-color: #028391">
                            <li><i class="fa fa-list"></i><a href="{{route('index_jadwal')}}">Index</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('tambah_jadwal')}}">Tambah Jadwal</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{route('jadwal.harian')}}">Tambah Jadwal Harian</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Finance</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Refund</a>
                        <ul class="sub-menu children dropdown-menu" style="background-color: #028391">
                            <li><i class="fa fa-eye"></i><a href="{{route('all_refund_admin')}}">Lihat Refund</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Pemasukan</a>
                        <ul class="sub-menu children dropdown-menu" style="background-color: #028391">
                            <li><i class="fa fa-eye"></i><a href="{{route('income.index2')}}">Lihat Pemasukan</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Another</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-sign-out"></i>Logout</a>
                        <ul class="sub-menu children dropdown-menu" style="background-color: #028391">
                            <li><i class="fa fa-sign-out"></i><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <div id="right-panel" class="right-panel">
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Halaman Admin Pelabuhan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('style/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('style/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('style/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('style/assets/js/main.js')}}"></script>
    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";
            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>
</body>

</html>