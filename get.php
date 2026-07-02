<?php 
	$contents='';
	foreach ($_GET as $key => $value) {
	    $contents .= $key . " => " . $value . "\n"; // or use `"\r\n"`            
	}
	file_put_contents('get2.txt', date('d.m.Y H:i:s',time()) ."\n". $contents, FILE_APPEND);
	// htmlspecialchars($_GET["event"])
?>