<?php
session_start();
//print_r($_SESSION);
if( !$_SESSION["employee_code"] ) {
	header( 'location: login.php' );
}
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
  <?php require_once 'nav.php'; ?>

  <div class="container-fluid" style="margin-top: 60px;">
	<?php require_once 'form_control.php'; ?>
	<center><div id="loading"></div></center>
	<div id="main"></div>
  </div>
  <?php require_once 'modal.php'; ?>
  <script src="script.js"></script>
  
  </body>
</html>