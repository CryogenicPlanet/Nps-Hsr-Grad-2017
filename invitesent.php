<?php
  $servername = getenv('IP');
    $username = "rahul";
    $password = "12345678";
    $database = "c9";
    $dbport = 3306;
      $db = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

  <body style="background: url('circuit_board_art-wallpaper-1920x1080.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="Source/simple-modal.js" type="text/javascript" charset="utf-8"></script>
      <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
            <script>
 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>
             <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
             <div class="row"></div>
                <div class="row"></div>
                
    <div class="row">
      <div class="col s6 offset-s3">
        <div class="card-panel teal">
      <ul class="collection with-header">
        <li class="collection-header"><h4>Invites Sent To</h4></li>
        <?php
        
    $sql = "SELECT Name FROM Invite ORDER BY Name";
    $result = $db->query($sql);

if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
        // echo $row['Name'];
        echo  "<li class='collection-item'>  Name: " . $row["Name"]."</li>";
    }
}
        ?>
      </ul>
            
          </span>
        </div>
      </div>
    </div>
         </body>
         </html>