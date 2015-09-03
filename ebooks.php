<!DOCTYPE html>
<?php
  session_start();
?>
<html class=''>
  <head>
    <meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="canonical" href="http://codepen.io/ashblue/pen/mCtuA" />

    <link rel='stylesheet prefetch' href='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'><link rel='stylesheet prefetch' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
    <style class="cp-pen-styles">
      .table-editable {
        position: relative;
      }
      .table-editable .glyphicon {
        font-size: 20px;
      }

      .table-remove {
        color: #700;
        cursor: pointer;
      }
      .table-remove:hover {
        color: #f00;
      }

      .table-up, .table-down {
        color: #007;
        cursor: pointer;
      }
      .table-up:hover, .table-down:hover {
        color: #00f;
      }

      .table-add {
        color: #070;
        cursor: pointer;
        position: absolute;
        top: 8px;
        right: 0;
      }
      .table-add:hover {
        color: #0b0;
      }
    </style>
  </head>




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

if ($result->num_rows > 0) {
    echo "<body> <div class='container'>
        <div id='table' class='table-editable'>
          <table class='table'>
            <tr>
              <th>Name</th>
              <th>Tags</th>
              <th>Uploaded</th>
              <th>Download</th>
              <th>Delete Ebook</th>
              <th>Move Up/Down</th>
            </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
              <td contenteditable='true'>".$row["location"]."</td>
              <td contenteditable='true'>Tag example</td>
              <td contenteditable='false'>2015-example</td>
              <td contenteditable='false'><a href='upload/".$row["location"]."' target='_blank' download>Download Ebook</a></td>
              <td>
                <span class='table-remove glyphicon glyphicon-remove'></span>
              </td>
              <td>
                <span class='table-up glyphicon glyphicon-arrow-up'></span>
                <span class='table-down glyphicon glyphicon-arrow-down'></span>
              </td>
            </tr>";
    }
    echo "</table>
          </div>
          <button id='export-btn' class='btn btn-primary'>Save Changes</button>
        <p id='export'></p>
      </div>";
} else {
    echo "No ebooks have been uploaded";
}
$conn->close();
?>


      <script src='//assets.codepen.io/assets/common/stopExecutionOnTimeout.js?t=1'></script><script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script><script src='http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script><script src='//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore.js'></script>
      <script>
      var $TABLE = $('#table');
      var $BTN = $('#export-btn');
      var $EXPORT = $('#export');
      $('.table-add').click(function () {
          var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
          $TABLE.find('table').append($clone);
      });
      $('.table-remove').click(function () {
          $(this).parents('tr').detach();
      });
      $('.table-up').click(function () {
          var $row = $(this).parents('tr');
          if ($row.index() === 1)
              return;
          $row.prev().before($row.get(0));
      });
      $('.table-down').click(function () {
          var $row = $(this).parents('tr');
          $row.next().after($row.get(0));
      });
      jQuery.fn.pop = [].pop;
      jQuery.fn.shift = [].shift;
      $BTN.click(function () {
          var $rows = $TABLE.find('tr:not(:hidden)');
          var headers = [];
          var data = [];
          $($rows.shift()).find('th:not(:empty)').each(function () {
              headers.push($(this).text().toLowerCase());
          });
          $rows.each(function () {
              var $td = $(this).find('td');
              var h = {};
              headers.forEach(function (header, i) {
                  h[header] = $td.eq(i).text();
              });
              data.push(h);
          });
          $EXPORT.text(JSON.stringify(data));
      });
      </script>
      <script src='//codepen.io/assets/editor/live/css_live_reload_init.js'></script>


    </body>

</html>