<?php
$uploaddir = realpath ( './upload' ) . '/';
$uploadfile = $uploaddir . basename ( $_FILES ['file_contents'] ['name'] );
if (move_uploaded_file ( $_FILES ['file_contents'] ['tmp_name'], $uploadfile )) {
} else {
	echo "Uploaded at uday's domain !\n";
}
?>