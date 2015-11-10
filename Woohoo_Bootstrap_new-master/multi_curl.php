<?php
$dir = realpath ( './uploads/new' );
if (is_dir ( $dir )) {
	if ($dh = opendir ( $dir )) {
		while ( ($file = readdir ( $dh )) !== false ) {
			global $filename1;
			$filename1 = $file;
		}
		closedir ( $dh );
	}
}
$filename = "/" . $filename1;
$urls = array (
		0 => 'http://www.udaydungarwal.com/Project/receive.php',
		1 => 'http://www.aarohioza.com/receive.php',
		1 => 'http://rutvimistry.info/accept.php' 
);

$file_name_with_full_path = $dir . $filename;
$post = array (
		'file_contents' => '@' . $file_name_with_full_path 
);

$mh = curl_multi_init ();
$handles = array ();

foreach ( $urls as $url ) {
	$handles [$url] = curl_init ( $url );
	curl_setopt ( $handles [$url], CURLOPT_URL, $url );
	curl_setopt ( $handles [$url], CURLOPT_POST, 1 );
	curl_setopt ( $handles [$url], CURLOPT_POSTFIELDS, $post );
	
	curl_multi_add_handle ( $mh, $handles [$url] );
}

$running = null;

do {
	curl_multi_exec ( $mh, $running );
	usleep ( 20000 );
} while ( $running > 0 );

foreach ( $handles as $key => $value ) {
	$handles [$key] = false;
	
	if (curl_errno ( $value ) === 0) {
		$handles [$key] = curl_multi_getcontent ( $value );
	}
	
	curl_multi_remove_handle ( $mh, $value );
	curl_close ( $value );
}

curl_multi_close ( $mh );
unlink ( $file_name_with_full_path );
?>