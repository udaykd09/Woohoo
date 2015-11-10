<?php
$images = $_POST ['cValues'];
foreach ( $images as $v ) {
	$a = "./" . $v;
	$dir = realpath ( $a );
	unlink ( $dir );
}
echo "Deleted! Please refresh";
?>