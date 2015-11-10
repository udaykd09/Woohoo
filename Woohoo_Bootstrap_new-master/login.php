<?php
session_start (); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset ( $_POST ['Signin'] )) {
	$con = mysqli_connect ( "udaydungarwalcom.fatcowmysql.com", "udaykd09", "123456", "207_lab6" );
	if (! $con) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error ();
	}
	$mail = isset ( $_POST ['mail'] ) ? $_POST ['mail'] : null;
	$pass = isset ( $_POST ['pass'] ) ? $_POST ['pass'] : null;
	
	$sql2 = "SELECT mail, password, firstname, lastname, moves FROM user_data where mail='$mail' and password='$pass'";
	$sql = 'SELECT * FROM `user_data` WHERE `mail` LIKE ' . $mail . '  AND `password` LIKE  ' . $pass;
	
	$result = mysqli_query ( $con, $sql2 );
	$row = mysqli_fetch_assoc ( $result );
	
	$fn = $row ["firstname"];
	$ln = $row ["lastname"];
	$moves = $row ["moves"];
	$mail = $row ["mail"];
	
	if (mysqli_num_rows ( $result ) == 1) {
		$_SESSION ['usr'] = 'yes'; // Initializing Session
		$_SESSION ['mail'] = $mail . "";
		$_SESSION ['moves'] = $moves . "";
		$_SESSION ['fn'] = $fn . "";
		$_SESSION ['ln'] = $ln . "";
        mysqli_close();
		header ( "Location: browse.php" );
		exit ();
	} else {
		$_SESSION ['err'] = 'yes';
		header ( "Location: error.php" );
		exit ();
	}
}
?>