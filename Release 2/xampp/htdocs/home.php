<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
  header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

if(isset($_GET["success"])) {
  if($_GET["success"] == "true") {
    ?><script>alert("Your file was uploaded successfully")</script><?php
  } else if($_GET["success"] == "invalid") {
    ?><script>alert("You are trying to upload an invalid file type. Make sure the file is compatible with the website.")</script><?php
  }
}

?>

<!DOCTYPE HTML>
<!--
    Parallelism by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html class = ''>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <link href="assets/css/dropzone.css" type="text/css" rel="stylesheet" /> 
        <link href="style.css" type="text/css" rel="stylesheet" /> 
        <link href="tables.css" type="text/css" rel="stylesheet" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome - <?php echo $userRow['email']; ?></title>
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->


<meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="canonical" href="http://codepen.io/ashblue/pen/mCtuA" />

    <link rel='stylesheet prefetch' href='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'><link rel='stylesheet prefetch' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>

    </head>
  
  
    <body>
    <form action="upload_file.php"
      class="dropzone"
      id="awesome-dropzone"></form>


     <!-- Wrapper-->
      <div id="wrapper">

        <!-- Nav -->
          <nav id="nav">
            <a href="#me" class="icon fa-home active"><span>Home</span></a>
            <a href="#video" class="icon fa-play-circle"><span>Video</span></a>
            <a href="#image" class="icon fa-camera"><span>Images</span></a>
            <a href="#audio" class="icon fa-volume-up"><span>Audio</span></a>
            <a href="#ebooks" class="icon fa-file-text"><span>E-Books</span></a>
            <a href="#search" class="icon fa fa-search"><span>Search</span></a>
            <a href="#profile" class="icon fa-user"><span>Profile</span></a>
          </nav>

        <!-- Main -->
          <div id="main">

            <!-- Me -->
              <article id="me" class="panel">
                <header style="width:55%; border-right:dashed">
                  <h1>Welcome <?php echo $userRow['username']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php?logout" style="text-decoration: none;">Sign Out</a></h1>
                  <p>Media Vault<br />Group 62</p>
                </header>
                <div style="float:right; width:35%; padding-top:5%">
                <br /><h1>Upload File</h1>
                  <form action="upload_file.php" method="post" enctype="multipart/form-data">
                  <label for="file" style="font-size:25px; color:white"><span>Upload File:</span></label>
                  <input type="file" name="file" id="file" />
                  <br />
                  <br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Upload"/>
                  </form>
                  </div>
              </article>

            <!-- Images -->
              <article id="image" class="panel" >
                <header>
                  <h2>Images</h2>
                </header>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbtest";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $user = $_SESSION['user'];

                $sql = "SELECT * FROM media
                WHERE owner = $user
                AND (type='image/jpeg' OR type='image/png' OR type='image/jpg')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) { ?>
                  <section>
                    <div class="row"> <?php
                      while($row = $result->fetch_assoc()) { ?>
                        <div class="4u 12u$(mobile)">
                          <a href="upload/<?php echo $row['location'] ?>" class="image fit"><img src="upload/<?php echo $row['location'] ?>" alt="" width="300" height="300"></a>
                          <?php echo $row['location'] ?>
                        </div> <?php
                      } ?>
                    </div> 
                </section>
                <?php 
                } 
                include_once('photos.php');
                ?>
              </article> 

              <!-- Images -->
              <article id="video" class="panel" >
                <header>
                  <h2>Videos</h2>
                </header>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbtest";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $user = $_SESSION['user'];

                $sql = "SELECT * FROM media
                WHERE owner = $user
                AND (type='video/mp4' OR type='video/ogg' OR type='video/avi')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) { ?>
                  <section>
                    <div class="row"> <?php
                      while($row = $result->fetch_assoc()) { ?>
                        <div class="4u 12u$(mobile)">
                          <video width="320" height="240" class="image fit" poster="http://hugequiz.com/wp-content/uploads/2014/01/video.png" controls>
                            <source src="upload/<?php echo $row['location'] ?>" type="video/mp4">
                            <source src="upload/<?php echo $row['location'] ?>" type="video/ogg">
                            <source src="upload/<?php echo $row['location'] ?>" type="video/avi">
                            Your browser does not support HTML5 video.
                          </video>
                          <?php echo $row['location'] ?>
                        </div> <?php
                      } ?>
                    </div> 
                </section>
                <?php 
                } 
                include_once('videos.php');
                ?>
              </article>

              <!-- eBooks -->
              <article id="ebooks" class="panel" >
                <header>
                  <h2>eBooks</h2>
                </header>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbtest";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $user = $_SESSION['user'];

                $sql = "SELECT * FROM media
                WHERE owner = $user
                AND (type='application/pdf')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) { ?>
                  <section>
                    <div class="row"> <?php
                      while($row = $result->fetch_assoc()) { ?>
                        <div class="4u 12u$(mobile)">
                          <div class="image fit">
                            <embed src="upload/<?php echo $row['location'] ?>" width="220" height="300" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
                          </div>
                          <?php echo $row['location'] ?>
                        </div> <?php
                      } ?>
                    </div> 
                </section>
                <?php 
                } 
                include_once('ebooks.php');
                ?>
              </article>  

              <!-- Audio -->
              <article id="audio" class="panel" >
                <header>
                  <h2>Audio</h2>
                </header>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbtest";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $user = $_SESSION['user'];

                $sql = "SELECT * FROM media
                WHERE owner = $user
                AND (type='audio/mp3' OR type='audio/mpeg' OR type='audio/ogg')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) { ?>
                  <section>
                    <div class="row"> <?php
                      while($row = $result->fetch_assoc()) { ?>
                        <div class="4u 12u$(mobile)">
                          <audio  class="image fit" controls>
                            <source src="upload/<?php echo $row['location'] ?>" type="audio/ogg">
                            <source src="upload/<?php echo $row['location'] ?>" type="audio/mpeg">
                            <source src="upload/<?php echo $row['location'] ?>" type="audio/mp3">
                            Your browser does not support HTML5 audio.
                          </audio>
                          <?php echo $row['location'] ?>
                        </div> <?php
                      } ?>
                    </div> 
                </section>
                <?php 
                } 
                include_once('music.php');
                ?>
              </article>

              <!-- Search -->
              <article id="search" class="panel" >
                <header>
                  <h2>Search</h2>
                </header>
                <form action="home.php#search" method="post">
                    <div class="row">
                      <div class="6u 12u$(mobile)">
                        <input type="text" name="search" placeholder="Search for tags" />
                      </div>
                      <div class="6u 12u$(mobile)">
                        <input type="submit" name='Search' id='Search' value="Search Tags" />
                      </div>
                    </div>
                  </form>
                  <?php
                    if(isset($_POST['search'])) {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "dbtest";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $user = $_SESSION['user'];
                    $search = $_POST['search'];

                    $sql = "SELECT * FROM media
                    WHERE owner = $user
                    AND (tags='".$search."')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "
                            <div id='table' class='table-editable'>
                              <table class='table'>
                                <tr>
                                  <th>Name</th>
                                  <th>Tags</th>
                                  <th>Uploaded</th>
                                  <th>Download</th>
                                  <th>Delete Media</th>
                                  <th>Move Up/Down</th>
                                </tr>";
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                  <td contenteditable='false'>".substr($row["location"], 0, 10)."</td>
                                  <td contenteditable='false'>".$row["tags"]."</td>
                                  <td contenteditable='false'>".$row["uploaded"]."<a name='" . $row["location"] . "'></a></td>
                                  <td contenteditable='false'><a href='upload/".$row["location"]."' target='_blank' download>Download Media</a></td>
                                  <td>
                                    <span class='table-remove glyphicon glyphicon-remove' id=".$row['location']." onClick='reply_click(this.id)'></span>
                                  </td>
                                  <td>
                                    <span class='table-up glyphicon glyphicon-arrow-up'></span>
                                    <span class='table-down glyphicon glyphicon-arrow-down'></span>
                                  </td>
                                </tr>";
                        }
                        echo "</table>
                              </div>
                            <p id='export'></p>
                          ";
                    } else {
                        echo "No tags matched your search";
                    }
                    $conn->close();
                  }
                  ?>
              </article>  

            <!-- Profile -->
              <article id="profile" class="panel">
                <header>
                  <h2>Profile Settings</h2>
                </header>
                <form action="update_profile.php" method="post">
                  <div>
                    <div class="row">
                      <div class="6u 12u$(mobile)">
                        <input type="text" name="username" placeholder="<?php echo $userRow['username'] ?>" />
                      </div>
                      <div class="6u$ 12u$(mobile)">
                        <input type="text" name="email" placeholder="<?php echo $userRow['email'] ?>" />
                      </div>
                      <div class="6u$ 12u$(mobile)">
                        <input type="text" name="password" placeholder="Update Password" />
                      </div>
                      <div class="6u$ 12u$(mobile)">
                      <?php
                        $user = $_SESSION['user'];

                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "dbtest";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        $sql = "SELECT * FROM media
                        WHERE owner = $user";
                        $result = $conn->query($sql);
                        $bytes = 0;

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $bytes += $row['size'];
                            }
                          }
                      ?>
                      You have uploaded <?php echo round($bytes/(1024 * 1024), 2) ?>mbs of data from your allocated 1024mb
                     <?php
                     $max = 1024;
                      $scale = 1.0;
                      $value = $bytes/(1024*1024);
                      if ( !empty($max) ) { $percent = ($value * 100) / $max; }
                      else { $percent = 0; }
                      if ( $percent > 100 ) { $percent = 100; }
                      
                      ?>
                        <div class="percentbar" style="width:"
                          <?php echo round(100 * $scale); ?>px;">
                          <div style="width:
                            <?php echo round($percent * $scale * 4); ?>px;">
                          </div>
                        </div>
                        Percentage: <?php echo round($percent, 2); ?>%
                        
                      </div>
                      <div class="6u$ 12u$(mobile)">
                        Uploads Video:
                        <?php
                        $sql = "SELECT * FROM media
                        WHERE owner = $user
                        AND (type='video/mp4' OR type='video/avi' OR type='video/mkv')";
                        $result = $conn->query($sql);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $count++;
                            }
                          }
                          echo $count;
                        ?>
                      </div>
                      <div class="6u$ 12u$(mobile)">
                        Uploads Audio:
                        <?php
                        $sql = "SELECT * FROM media
                        WHERE owner = $user
                        AND (type='audio/mp3' OR type='audio/wma')";
                        $result = $conn->query($sql);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $count++;
                            }
                          }
                          echo $count;
                        ?>
                      </div>
                      <div class="6u$ 12u$(mobile)">
                        Uploads Images: 
                        <?php
                        $sql = "SELECT * FROM media
                        WHERE owner = $user
                        AND (type='image/jpeg' OR type='image/png' OR type='image/jpg')";
                        $result = $conn->query($sql);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $count++;
                            }
                          }
                          echo $count;
                        ?>
                      </div>
                      <div class="6u$ 12u$(mobile)">
                        Uploads eBooks: 
                        <?php
                        $sql = "SELECT * FROM media
                        WHERE owner = $user
                        AND (type='application/pdf')";
                        $result = $conn->query($sql);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $count++;
                            }
                          }
                          echo $count;
                        ?>
                      </div>
                      <div class="12u$">
                        <input type="submit" name='Update' id='Update' value="Update Profile " />
                      </div>
                    </div>
                  </div>
                </form>
              </article>

          </div>

        <!-- Footer -->
          <div id="footer">
            <ul class="copyright">
              <li>&copy; Vault 62</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
            </ul>
          </div>

      </div>

    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/skel.min.js"></script>
      <script src="assets/js/skel-viewport.min.js"></script>
      <script src="assets/js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="assets/js/main.js"></script>
      <script src="assets/js/dropzone.js"></script>

      

  </body>
</html>