<?php
session_start (); // Starting Session
$mail = "kad";
$_SESSION ['user'] = $mail; // Initializing Session
                         // $_SESSION['username'] = $user['mail'];
$abc = $_SESSION ['user'];
header ( "Location: browse.php" );
?>