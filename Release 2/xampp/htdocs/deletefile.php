<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbtest";

$base_directory = 'upload/';

$file = $_GET['file'];
$type = $_GET['type'];

if(unlink($base_directory.$_GET['file'])) {
    //echo "File Deleted.";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



// sql to delete a record
$sql = "DELETE FROM media WHERE location='" . $file . "'";

if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
    if($type == 'image') {
    	header("Location: http://localhost/home.php#image");
    } else if($type == 'video') {
    	header("Location: http://localhost/home.php#video");
    } else if($type == 'audio') {
    	header("Location: http://localhost/home.php#audio");
    } else if($type == 'ebook') {
    	header("Location: http://localhost/home.php#ebook");
    }
    
} else {
    if($type == 'image') {
    	header("Location: http://localhost/home.php#image");
    } else if($type == 'video') {
    	header("Location: http://localhost/home.php#video");
    } else if($type == 'audio') {
    	header("Location: http://localhost/home.php#audio");
    } else if($type == 'ebook') {
    	header("Location: http://localhost/home.php#ebook");
    }
}

$conn->close();
?>