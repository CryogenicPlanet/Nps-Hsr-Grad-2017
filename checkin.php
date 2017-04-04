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
    //$authcode = $_POST['authcode'];
    $password = $_REQUEST['password'];
    if($password == "7f7d47f1ff6bf26a221b21ae3bde1074"){
    $authcode = $_REQUEST['authcode'];
    if($authcode =="conCheck"){
        echo "true";
        exit;
    }
$status = checkError($db,$authcode);
 if($status != "sucess"){
     echo $status;
}else{
    $sql = "UPDATE Invite SET checkedIn=1 WHERE Code='" .$authcode."'";
if ($db->query($sql) === TRUE) {
    echo "sucess";
} else {
    echo "Error updating record: " . $conn->error;
}
}
}
function checkError($db,$authcode){
    
    $sql ="SELECT checkedIn FROM Invite WHERE Code='" . $authcode."'";
     $result = $db->query($sql);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
             if($row['checkedIn'] == 1){
                 return "Already Checked In";
             }
         }
    }else{
        return "Invalid Authentication Code";
    }
    return "sucess";
}
$db->close();

?>
