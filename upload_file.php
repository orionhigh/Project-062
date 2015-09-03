<?php

session_start();
include_once 'dbconnect.php';

$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "PNG", "pdf", "avi", "mkv");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "video/avi")
|| ($_FILES["file"]["type"] == "video/mkv")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "image/jpeg"))

&& in_array($extension, $allowedExts))

  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Erro Uploading Files Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists in your media vault. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "File uploaded Successfully";

      $sql="INSERT INTO media (location, owner, type) VALUE('".$_FILES["file"]["name"]."','".$_SESSION['user']."','".$_FILES["file"]["type"]."')";
      $result=mysql_query($sql);
      }
    }
  }
else
  {
  echo "Trying to upload an invalid file type";
  }
  header("Location: {$_SERVER['HTTP_REFERER']}");
?>