<?php
	header('Content-type: application/json');
	include_once 'dbconnect.php';

	$json = file_get_contents('php://input');
	$json_decode = json_decode($json, true); 
	$json_encode = json_encode($json_decode);

	for($i = 0; $i < count($json_decode); $i++) {
	  $sql="UPDATE media SET tags='".$json_decode[$i]['tags']."' WHERE location='".$json_decode[$i]['location']."'";
      $result=mysql_query($sql);
      $sql="UPDATE media SET name='".$json_decode[$i]['name']."' WHERE location='".$json_decode[$i]['location']."'";
      $result=mysql_query($sql);
	}


	echo "{}";

?>