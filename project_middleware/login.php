<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProjectCodeSystem</title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/jquery-1.11.3.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
    <script src="../bootstrap/js/html5shiv.js"></script>
    <script src="../bootstrap/js/respond.js"></script>
    <![endif]-->
  </head>
  <body class="bg-default">
    <!--Main start-->
    <div class="container-fluid" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ProjectCodeSystem <small>-Login Form-</small></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="employee_code" name="employee_code" type="text" autofocus value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="password" name="password" type="password" value="">
                                </div>
                                <button class="btn btn-lg btn-block" style="background-color: black; color: white;">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
<?php
if( $_SERVER["REQUEST_METHOD"] === 'POST' ) {
	require_once 'check_user.php';
	if( $cnt ) {
		$_SESSION["employee_code"] = $_REQUEST["employee_code"];
		$_SESSION["admin"] = $admin;
		header( 'location: ./' );
	}
}