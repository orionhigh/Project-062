<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>

<!DOCTYPE HTML>
<!--
    Parallelism by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
		<link href="assets/css/dropzone.css" type="text/css" rel="stylesheet" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome - <?php echo $userRow['email']; ?></title>
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    </head>
	
	
    <body>
	<!-- Drag & Drop -->
    <form action="upload_file.php"
      class="dropzone"
      id="awesome-dropzone"></form>

<!--<div id="wrapper">
<aside class="Title 1"><strong></strong></aside>
<h4 style="color: #000000; font-size: 50px; position: relative; top: 10%;">Project-062</h4> -->
<!--<div class="label" id="header"> </div>-->
<div id="wrapper">
<div id="main">
  <div id="reel">
   
   
    <!--Header Item  -->
    
    
    <div id="header" class="item" data-width="450" style="padding-top:0em">
	
    <div style="font-size:25px; color:white">
    Welcome <?php echo $userRow['username']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php?logout">Sign Out</a>
    </div>
    <h2>Project 062</h2>
    <br />

    <form action="upload_file.php" method="post" enctype="multipart/form-data">
    <label for="file" style="font-size:25px; color:white"><span>Upload File:</span></label>
    <input type="file" name="file" id="file" /> 
    <br />
    <input type="submit" name="submit" value="Upload" />
    </form>
	
     <!-- <p style="font-size: 60px;  width: 400px;">
      Project-062 </p>
<div class="inner"> </div>  -->
                        </div> 
                        <!--<div id="header" class="item" data-width="400"> -->

                        
                        
                       <!--  <a href="upload/0001.jpg" download> -->
    
    <!-- Thumb Items -->
	<!-- <div class="item" data-width="320">
		<form action="upload_file.php" class="dropzone"></form>
	</div> -->
	
    <article class="item thumb" data-width="256">
      <a class="sprite_stumbleupon" href="videos.php" target="_blank" onclick="return windowpop(this.href, 1000, 433)"><h2>Videos</h2></a>
      <a href="images/png/play-button4.png" class="image"><img src="images/png_half/play-button4.png" alt=""></a> </article>
    <article class="item thumb" data-width="256">
      <a class="sprite_stumbleupon" href="music.php" target="_blank" onclick="return windowpop(this.href, 1000, 433)"><h2>Music.</h2></a>
      <a href="images/png/circular263.png" class="image"><img src="images/png_half/circular263.png" alt=""></a> </article>
    <article class="item thumb" data-width="256">
      <a class="sprite_stumbleupon" href="ebooks.php" target="_blank" onclick="return windowpop(this.href, 1000, 433)"><h2>eBooks</h2></a>
      <a href="images/png/books8.png" class="image"><img src="images/png_half/books8.png" alt=""></a> </article>
    <article class="item thumb" data-width="256">
      <a class="sprite_stumbleupon" href="photos.php" target="_blank" onclick="return windowpop(this.href, 1000, 433)"><h2>Photos</h2></a>
      <a href="images/png/camera3.png" class="image"><img src="images/png_half/camera3.png" alt=""></a> </article>
      <article class="item thumb" data-width="256">
      <h2>Settings</h2>
      <a href="images/png/gear39.png" class="image"><img src="images/png_half/gear39.png" alt=""></a> </article>
  </div>
  </div>
  <!-- Filler Thumb Items (just for demonstration purposes) 
                        <article class="item thumb" data-width="476"><h2>Movies</h2><a href="images/fulls/05.jpg" class="image"><img src="images/thumbs/05.jpg" alt=""></a></article>
                        <article class="item thumb" data-width="232"><h2>TV Shows</h2><a href="images/fulls/05.jpg" class="image"><img src="images/thumbs/05.jpg" alt=""></a></article>
                        <article class="item thumb" data-width="352"><h2>Music</h2><a href="images/fulls/05.jpg" class="image"><img src="images/thumbs/05.jpg" alt=""></a></article>
                        <article class="item thumb" data-width="348"><h2>Photos</h2><a href="images/fulls/05.jpg" class="image"><img src="images/thumbs/05.jpg" alt=""></a></article>
                        <article class="item thumb" data-width="282"><h2>eBooks</h2><a href=
"images/fulls/05.jpg" class="image"><img src="images/thumbs/05.jpg" alt=""></a></article>
                </div>
            </div> -->
			
	
	
  <div id="footer">
    <div class="left"> </div>
    <div class="right">
      <ul class="contact">
        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
        <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
        <li><a href="#" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
        <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
      </ul>
      <ul class="copyright">
        <li>&copy; Project 62</li>
        <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
      </ul>
    </div>
  </div>
  
</div>


<!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.poptrox.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/skel-viewport.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>
			<script src="assets/js/dropzone.js"></script>

    </body>
</html>