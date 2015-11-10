<?php
// Create connection servername,db username, db password, database name
$con = mysqli_connect ( "udaydungarwalcom.fatcowmysql.com", "udaykd09", "123456", "207_lab6" );

// Check connection
if (! $con) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

$mail = isset ( $_POST ['mail'] ) ? $_POST ['mail'] : null;
$pass = isset ( $_POST ['pass'] ) ? $_POST ['pass'] : null;
$firstname = isset ( $_POST ['firstname'] ) ? $_POST ['firstname'] : null;
$lastname = isset ( $_POST ['lastname'] ) ? $_POST ['lastname'] : null;
$gender = isset ( $_POST ['gender'] ) ? $_POST ['gender'] : null;
$moves = 100;

if (isset ( $_POST ['Signup'] )) {
	$sql2 = "SELECT mail FROM user_data where mail='$mail'";
	$result = mysqli_query ( $con, $sql2 );
	$row = mysqli_fetch_assoc ( $result );
	if (mysqli_num_rows ( $result ) == 0) {
		// inserting record
		$sql1 = "INSERT INTO user_data (firstname, lastname, gender, mail, password, moves) VALUES ('$firstname','$lastname','$gender','$mail','$pass','$moves')";
		
		if (! mysqli_query ( $con, $sql1 )) {
			die ( 'Error: ' . mysqli_error ( $con ) );
		}
		header ( "Location: index.php?name=" . $firstname );
	} else {
		$insert_err = "We have found a record with the same Email. Please reenter valid details";
		header ( "Location: register.php?insertMsg=" . $insert_err );
	}
}
?>