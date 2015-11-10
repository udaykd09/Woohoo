<?php
session_start ();
if (empty ( $_SESSION ['usr'] )) {
	echo "<script>window.open('index.php','_self')</script>";
}
$fn = $_SESSION ['fn'];
$ln = $_SESSION ['ln'];
$mail = $_SESSION ['mail'];
$moves = $_SESSION ['moves'];

// $ln=$_GET['ln'];
// $mail=$_GET['mail'];
// $moves=$_GET['moves'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Home Page</title>
<meta name="generator" content="Bootply" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<style>
.bg {
	background-size: 100% auto;
}

body {
	background: black;
}

.btn-file {
	position: relative;
	overflow: hidden;
}

.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity = 0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}

.btn-submit {
	position: relative;
	overflow: hidden;
}

.btn-submit input[type=submit] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity = 0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}

h4 {
	color: darkgray;
}
</style>

</head>
<body>
	<div id=bodyDiv>
		<div id="long" class="show bg" tabindex="-1" role="dialog"
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
						<h4 class="text-center"><?php echo $fn." ".$ln." (Score: ".$moves.")";?></h4>
					</div>

					<div class="modal-body">
						<div class="text-center">

							<div>
								<form id="profile" method="post" action="">
									<button type="button" title="Profile"
										class="btn btn-primary btn-lg btn-submit">
										<span class="glyphicon glyphicon-user" style="font-size: 3em"
											aria-hidden="true"></span> <input type="submit"
											name="profile"></input>
									</button>
									<button type="button" title="Gallery"
										class="btn btn-primary btn-lg btn-submit" align="Right">
										<span class="glyphicon glyphicon-picture"
											style="font-size: 3em"></span> <input type="submit"
											name="picture"></input>
									</button>
								</form>
							</div>

							<div>
								<br>
							</div>

							<div>
								<form id="woohoo" method="post" action=""
									enctype="multipart/form-data">
									<button type="button" title="Select File"
										class="btn btn-primary btn-lg btn-file">
										<span class="glyphicon glyphicon-camera"
											style="font-size: 3em"></span> <input type="file"
											name="fileToUpload" id="fileToUpload"
											onchange="picChange(event)" accept="image/*;capture=camera"
											multiple>
									</button>
									<button type="button" title="Upload File"
										class="btn btn-primary btn-lg btn-submit">
										<span class="glyphicon glyphicon-upload"
											style="font-size: 3em" aria-hidden="true"></span> <input
											type="submit" name="submit" value="Upload Image">
									</button>
								</form>
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<div class="text-center">
							<font face="Comic Sans MS" size="3">
                                
                                <?php
																																if (isset ( $_POST ['profile'] )) {
																																	include ('profile.php');
																																} elseif (isset ( $_POST ['picture'] )) {
																																	include 'display.php';
																																} elseif (isset ( $_POST ['submit'] )) {
																																	include "upload3.php";
																																}
																																
																																?>
</font>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
window.setTimeout("location=('logout.php');",900000);
</script>
</body>
</html>