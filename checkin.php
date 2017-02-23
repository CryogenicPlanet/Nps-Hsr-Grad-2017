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
    $authcode = $_REQUEST['authcode'];

 if(checkError($db,$authcode) == "sucess"){
     
     $sql = "UPDATE Test SET checkedIn=1 WHERE Code='" .$authcode."'";
if ($db->query($sql) === TRUE) {
    echo "sucess";
} else {
    echo "Error updating record: " . $conn->error;
}
}else{
    echo checkError($db,$authcode);
}

function checkError($db,$authcode){
    
    $sql ="SELECT checkedIn FROM Test WHERE Code='" . $authcode."'";
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
