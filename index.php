<!DOCTYPE html>
<html>
<head>
	<title>VaptVupt - Sistema</title>
	<script type="text/javascript" src="/db2/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/db2/js/validator.min.js"></script>
	<script type="text/javascript" src="/db2/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/db2/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/db2/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="/db2/bootstrap/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="/db2/bootstrap/css/bootstrap-theme.min.css.map">
</head>
<body>
	<div class="container-fluid">
		<?php
		session_start();
		if(!isset($_SESSION["login"])) {
			include_once("login.php");
		}
		else {
			include_once("syscontrol.php");
		}
		?>
	</div>
</body>
</html>