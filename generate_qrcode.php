<?php
require_once('vendor/endroid/qrcode/src/QrCode.php');
use Endroid\QrCode\QrCode;
    $servername = getenv('IP');
    $username = "rahul";
    $password = "12345678";
    $database = "c9";
    $dbport = 3306;
   
   
$qrCodeText ='This is an invitation to Nps Hsr 10th Grade Grad Party At (our location) on 8th of April(mostly) from 7 pm to 11 pm(again to change with change in time) for : ';
$name = $_POST['firstname'];
$password = $_POST['password'];

$email = $_POST['email'];
$hashed = md5($password);
if ($hashed == "af0133b1b5763e9e571fd77e5be993e4" || $hashed == "25d55ad283aa400af464c76d713c07ad" || $hashed  == "25d55ad283aa400af464c76d713c07ad") {
  $db = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    $string;
    $temp = 0;
    while($temp = 0){
    $rdrString = generateRandomString(12);
    $sql = "SELECT Name FROM Invite WHERE Code='" .$rdrString ."'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
} else{
    $string = $rdrString;
    $temp = 1;

}
    }
$qrCodeText = $qrCodeText . $name . ".This invite is only for one.";
$qrCodeText = $qrCodeText . $string;
 $sql = "INSERT INTO Invite (Name, Code)
VALUES ('".$name."','".$string ."')";

if ($db->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$db->close();
$qrCode = new QrCode();
$qrCode
    //->setText('This is an invitation to Nps Hsr 10th Grade Grad Party At (our location) on 8th of April(mostly) from 7 pm to 11 pm(again to change with change in time) for :')
    ->setText($qrCodeText)
    ->setSize(300)
    ->setPadding(10)
    ->setErrorCorrection('high')
    ->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0])
    ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0])
    ->setLabel('Scan the code')
    ->setLabelFontSize(16)
    ->setImageType(QrCode::IMAGE_TYPE_PNG)
;

// now we can directly output the qrcode
header('Content-Type: '.$qrCode->getContentType());
$qrCode->render();
// save it to a file
$qrCode->save('qrcode.png');
//enable below to send emails
sendMail($email);
/*
// using phpmailer
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging

$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'ssl://email-smtp.us-east-1.amazonaws.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
// I tried PORT 25, 465 too
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "AKIAIIG5KZVRZRJYK7CQ";

//Password to use for SMTP authentication
$mail->Password = "AnAmQG7R3OlH9PcaOn13hOEbitVdmeH3ZKk+siUGKtLT";

//Set who the message is to be sent from
$mail->setFrom('npshsrgrad2017@gmail.com', 'sender');

//Set who the message is to be sent to
$mail->addAddress($email, 'receiver');

//Set the subject line
$mail->Subject = 'Grad Party Invitation';


$mail->Body = 'This is invitaion to grad party from AWS through php mailer';
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

*/
//$response = new Response($qrCode->get(), 200, ['Content-Type' => $qrCode->getContentType()]);
} else {
    echo "Invalid Password";
}
function sendMail($sento){
require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
  ->setUsername('npshsrgrad2017@gmail.com')
  ->setPassword('sherlocked');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Grad Party Invitation')
  ->setFrom(array('npshsrgrad2017@gmail.com' => 'Nps Hsr Grad Party'))
  ->setTo(array($sento))
  ->setBody('This is the invitaion to the grad party, Please bring the QrCode with you when you come for the party')
  ->attach(Swift_Attachment::fromPath('qrcode.png'));

$result = $mailer->send($message);
 if (!$mailer->send($message, $failures))
{
  echo "Failures:";
  print_r($failures);
}
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>