
<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Смотреть фильмы</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.0/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ url('/admins/css/film.css') }}">
    <meta class="tokencf" name="csrf-token" content="{{ csrf_token() }}">


    <script src="{{ url('/admins/js/jquery.js') }}"></script>
    <script src="{{ url('/admins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/admins/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ url('/admins/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/admins/js/main.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>

    <nav class="topnav">
        <div class="menuDiv">
            <a class="home" href="http://localhost1/public/"></a>
<!--            <img class="logo" id="logo" alt="welcome" src="/storage/app/public/upload/img.png">-->
<!--            <i class="fa fa-paper-plane" style="font-size: 32px"></i>-->
            <a href="http://localhost1/public/new">Новинки</a>
            <a href="http://localhost1/public/top">Топ 200</a>
            <a href="http://localhost1/public/random">Случайный</a>
            <a href="#">NE UKAZANO</a>
            <div class="search-container">
                <form action="/public/search" method="POST">
                    @csrf
                    <input class="searchInput" type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            @if(Session::has('role'))
            <a href="/public/profile">{{Session::get('name')}}</a>
            <a href="/public/logout">Выйти</a>
            @else

            <a data-toggle="modal" data-target="#modalLRForm">Логин / Регистрация</a>
            @endif
        </div>

    </nav>







    <!--Modal: Login / Register Form-->
    <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">

                <!--Modal cascading tabs-->
                <div class="modal-c-tabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id ="log" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
                                Логин</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reg" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
                                Регистрация</a>
                        </li>
                    </ul>

                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!--Panel 7-->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                            <!--Body-->
                            <form action="{{'/public/login'}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body mb-1">
                                    <h5>Добро пожаловать</h5>
                                    <div class="welcomeDiv" style="margin:25px auto;"><img class="welcome" alt="welcome" src="/storage/app/public/upload/img.png"></div>
                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput10">Е-маил</label>
                                        <input type="email" id="modalLRInput10" class="form-control form-control-sm validate" name="email">

                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-unlock-alt prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput11">Пароль</label>
                                        <input type="password" id="modalLRInput11" class="form-control form-control-sm validate" name="password">

                                    </div>
                                    <div class="text-center mt-2">
                                        <button type="submit" class="btn btn-warning">Войти <i class="fas fa-sign-in-alt"></i></button>
                                    </div>
                                </div>
                            </form>
                            <!--Footer-->
                            <div class="modal-footer">
                                <div class="options text-center text-md-right mt-1">
                                    <p>Не участник? <button type="button" class="btn btn-info blue-text sign-up" onclick="sign()">Зарегистрироваться</button></p>
                                    <p>Забыли <a href="#" class="blue-text">Пароль?</a></p>
                                </div>
                                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Закрыть</button>
                            </div>


                        </div>
                        <!--/.Panel 7-->

                        <!--Panel 8-->
                        <div class="tab-pane fade" id="panel8" role="tabpanel">

                            <!--Body-->
                            <form action="{{'/public/registration'}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="welcomeDiv"><img class="welcome" alt="welcome" src="/storage/app/public/upload/img1.png"></div>

                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-user-alt prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput10">Имя</label>
                                        <input type="text" id="modalLRInput10" class="form-control form-control-sm validate" name="name">

                                    </div>
                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-envelope prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput12">Е-маил</label>
                                        <input type="email" id="modalLRInput12" class="form-control form-control-sm validate" name="email">
                                    </div>

                                    <div class="md-form form-sm mb-5">
                                        <i class="fas fa-unlock-alt prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput13">Пароль</label>
                                        <input type="password" id="modalLRInput13" class="form-control form-control-sm validate" name="password">
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-unlock prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput14">Повтор паролья</label>
                                        <input type="password" id="modalLRInput14" class="form-control form-control-sm validate" name="re_password">
                                    </div>
                                    <div class="text-center form-sm mt-2">
                                        <button class="btn btn-warning">Зарегистрироваться <i class="fas fa-sign-in-alt"></i></button>
                                    </div>

                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="options text-right">
                                    <p class="pt-1">Уже есть аккаунт? <button class="btn btn-info blue-text log-in" onclick="login()">Войти</button></p>
                                </div>
                                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Закрыть</button>
                            </div>

                            <!--Footer-->


                        </div>
                        <!--/.Panel 8-->
                    </div>

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: Login / Register Form-->

    <div class="containerSite">
        <div class="content">
            <div class="categoryYear">
                <x-Categories/>

            </div>

        </div>

        @include('site.flash-message')
        @yield('content')

    </div>



    <!-- Main Footer -->
    <div class="clear emptyDiv"></div>
</div>
<footer class="main-footer">
    <nav class="bottomnav">
        <div class="menuDiv">

        </div>

    </nav>

</footer>

<!-- ./wrapper -->




</body>
</html>


















