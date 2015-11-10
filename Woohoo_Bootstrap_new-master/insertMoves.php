<?php
session_start ();
$mail = $_SESSION ['mail'];
// Create connection servername,db username, db password, database name
$con = mysqli_connect ( "udaydungarwalcom.fatcowmysql.com", "udaykd09", "123456", "207_lab6" );

// Check connection
if (! $con) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

$moves = $_GET ['moves'];

$sql1 = "UPDATE user_data SET moves = '$moves' WHERE mail='$mail'";

$_SESSION ['moves'] = $moves;

if (! mysqli_query ( $con, $sql1 )) {
	die ( 'Error: ' . mysqli_error ( $con ) );
}

?>