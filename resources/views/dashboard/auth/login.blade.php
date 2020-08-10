<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../admins/css/bootstrap.min.css">
        <link rel="stylesheet" href="../admins/css/style.css">
        <script src="../admins/js/jquery.js"></script>
        <script src="../admins/js/bootstrap.min.js"></script>
        <script src="../admins/js/js.js"></script>


        <title>Admin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->

    </head>
    <body>

        <div class="container">
            <h1>PLEASE SIGN IN</h1>
            <form class="form-horizontal" method="post" action="{{'/public/admin/login'}}" enctype="multipart/form-data" id="myform">
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-2" for="login">Login:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" autocomplete="off">
                    
                    <div class="col-sm-10 adminLogDiv"><input type="submit" class="btn btn-default" name="adminlog" value="Submit"></div>
                </div>   
                
            </form>
			</div>
			</div>


    </body>
</html>