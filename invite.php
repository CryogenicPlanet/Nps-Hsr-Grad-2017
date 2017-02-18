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
    $conflict = 0;
  $name = $_POST['firstname'];
$password = $_POST['password'];
$go = 0;
$email = $_POST['email'];
$hashed = md5($password);
if ($hashed == "af0133b1b5763e9e571fd77e5be993e4" || $hashed == "015c06a32527a5fb677fb29cdb79c807" || $hashed  == "7f7d47f1ff6bf26a221b21ae3bde1074") {
  $go =1;
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
        <div class="card-panel cyan">
      <ul class="collection with-header">
        
        <?php
        if($go ==1){
    $sql = "SELECT Name FROM Invite ORDER BY Name";
    $result = $db->query($sql);
  echo '<li class="collection-header"><h4><p>You Want to Send Invite to -'. $name . '.</h4><p> Please confirm they have not already got an Invite with a slightly different name or in their last name.</li>';
if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
        // echo $row['Name'];
        
        if(strstr($row['Name'],$name)){
          echo  "<li class='collection-item red darken-1'><span class='white-text'> Name: " . $row["Name"]."</span></li>";
          $conflict = 1;
        }else {
        echo  "<li class='collection-item'>  Name: " . $row["Name"]."</li>";
        }
    }
}
if($conflict == 0){
echo '
</ul>
  <div class="row">
    <form class="col s12" method="post" action="generate_qrcode.php">
      <div class="row">
        <div class="input-field col s6">
          <input  name="name" type="hidden" value="'. $name . '">
          <input  name="email" type="hidden" value="'. $email . '">
           <input  name="conflict" type="hidden" value=0>
          <input  name="password" type="hidden" value="password">
          <button class="btn waves-effect waves-light" type="submit" name="action">Confirm 
    <i class="material-icons right">send</i>
  </button>
        
        </div> 
        </form>';
} else {
    echo '</ul>
  <div class="row">
    <form class="col s12" method="post" action="generate_qrcode.php">
      <div class="row">
        <div class="input-field col s6">
          <input  name="name" type="hidden" value="'. $name . '">
          <input  name="email" type="hidden" value="'. $email . '">
          <input  name="conflict" type="hidden" value=1>
          <p><h6> Please Re Enter your password to confirm you want to send an Invite. We have found a conflict with someone elses name </h6> </p>
          <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password" class="red-text darken-4">Overide Code</label>
        </div>
      </div>
      
          <button class="btn waves-effect waves-light red darken-4" type="submit" name="action"> Are you Sure you want to Confirm?
    <i class="material-icons right">send</i>
  </button>
        
        </div> 
        </form>';      
        }
}else {
  echo '</ul>';
  echo"<h3> Invalid Password </h3>";
}
        ?>
      </ul>
            
          </span>
        </div>
      </div>
    </div>
         </body>
         </html>