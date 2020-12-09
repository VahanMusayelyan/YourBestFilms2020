
<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('/admins/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/admins/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('/admins/css/admin.css') }}">

    <script src="{{ url('/admins/js/jquery.js') }}"></script>
    <script src="{{ url('/admins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/admins/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ url('/admins/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/admins/js/js.js') }}"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">



        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" id="menuDesc">
            <!-- Brand Logo -->
            <a href="/admin/" class="brand-link">
                <img src="{{url('/admins/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Start 
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/film" class="nav-link" id="film_link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Films</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/category" class="nav-link" id="cat_link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/country" class="nav-link" id="country_link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Countries</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/news" class="nav-link" id="news_link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>News</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form method="post" action="{{route('logout')}}" class="form-logout">
                                        @csrf
                                        <button class="btn" style="color:white"><i class="fas fa-sign-out-alt" style="color:white"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        @yield('content')



    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020 <a href="/admin/">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->




</body>
</html>


















