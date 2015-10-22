<?php

session_start();
include_once 'dbconnect.php';

$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "PNG", "pdf", "avi", "mkv", "pjpeg");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$datetime = date_create()->format('Y-m-d H:i:s');

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "video/avi")
|| ($_FILES["file"]["type"] == "video/mkv")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "image/jpeg"))

&& in_array($extension, $allowedExts))

  {
  if ($_FILES["file"]["error"] > 0)
    {
    //echo "Error Uploading Files Return Code: " . $_FILES["file"]["error"] . "<br />";
      header("Location: http://localhost/home.php?success=invalid");
    }
  else
    {

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      //echo $_FILES["file"]["name"] . " already exists in your media vault. ";
        header("Location: http://localhost/home.php?success=invalid");
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      //echo "File uploaded Successfully";

      if (($_FILES["file"]["type"] == "video/mp4")
      || ($_FILES["file"]["type"] == "video/avi")
      || ($_FILES["file"]["type"] == "video/mkv")) {
        $tags = "Video";
      } else if (($_FILES["file"]["type"] == "image/pjpeg")
      || ($_FILES["file"]["type"] == "image/jpg")
      || ($_FILES["file"]["type"] == "image/png")
      || ($_FILES["file"]["type"] == "image/gif")
      || ($_FILES["file"]["type"] == "image/jpeg")) {
        $tags = "Image";
      } else if (($_FILES["file"]["type"] == "audio/mp3") 
      || ($_FILES["file"]["type"] == "audio/wma")) {
        $tags = "Audio";
      } else if ($_FILES["file"]["type"] == "application/pdf") {
        $tags = "eBook";
      }


      $sql="INSERT INTO media (location, owner, type, tags, name, size, uploaded) VALUE('".$_FILES["file"]["name"]."','".$_SESSION['user']."','".$_FILES["file"]["type"]."','".$tags."','".$_FILES["file"]["name"]."','".$_FILES["file"]["size"]."','".$datetime."')";
      $result=mysql_query($sql);
      header("Location: http://localhost/home.php?success=true");
      }
    }
  }
else
  {
  //echo "Trying to upload an invalid file type";
  header("Location: http://localhost/home.php?success=invalid");
  }
?>