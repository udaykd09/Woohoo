
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Login Form</title>
<meta name="generator" content="Bootply" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<!--login modal-->
	<div id="long" class="show" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" title="Logout" class="close"
						data-dismiss="modal" aria-hidden="true">
						<a href="logout.php">×</a>
					</button>
					<div>
						<br>
					</div>
					<h1 class="text-center">
						<img src='woohoo1.png' alt='Cinque Terre' width='160' height='70'>
					</h1>
				</div>
				<div class="modal-body">
					<form class="form col-md-12 center-block" action="login.php"
						method="post">
						<div class="form-group">
							<input type="text" class="form-control input-lg"
								placeholder="Email" name="mail" required="true">
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg"
								placeholder="Password" name="pass" required="true">
						</div>
						<div class="form-group">
							<input type="submit" name="Signin" value="Sign In"
								class="btn btn-primary btn-lg btn-block"> <span
								class="pull-right"><a
								href="http://www.udaydungarwal.com/Project/register.php"><font
									face="Helvetica Neue" size="3">New User? Register here!</font></a></span><br>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div class="text-center">
<?php
if (isset ( $_POST ['Signup'] )) {
	$name = $_GET ['name'];
	echo "We have added you, " . $name . "! please login now";
}
?>
</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>