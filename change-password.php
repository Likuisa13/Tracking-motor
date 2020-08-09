<?php
include_once 'config/dao.php';
$dao = new Dao();
if (empty($_GET['email']) || empty($_GET['token'])) {
	header("location:index");
}
else{
	if (!$dao->validToken($_GET['email'],$_GET['token'])) {
		header("location:index");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password | Smart-Tracking</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="icon" href="img/icon.png">
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading"><center>Change Your Password</center></div>
				<div class="panel-body">
					<form role="form" action="_forgot_pass" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" name="aksi" type="hidden" value="change">
								<input class="form-control" name="email" type="hidden" value="<?= $_GET['email']; ?>">
								<input class="form-control" placeholder="New Password" name="password" type="password" value="">
							</div>
                            <div class="form-group">
								<input class="form-control" placeholder="New Password Retype" name="password-retype" type="password" value="">
							</div>
							<button type="submit" class="btn btn-primary">Submit</button></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
