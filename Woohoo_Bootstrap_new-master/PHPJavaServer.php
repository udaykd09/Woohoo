<?php
$filename = $_GET ['fileName'];
$fileData = file_get_contents ( 'php://input' );
$fhandle = fopen ( "uploads//new//" . $filename, 'wb' );
fwrite ( $fhandle, $fileData );
fclose ( $fhandle );
include "multi_curl.php";
echo ("Done uploading");
?>