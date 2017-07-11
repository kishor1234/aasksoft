<?php
function  mailSend($email,$link)
{
    $to = $email;
$subject = "Email Verification ";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This Verification mail from RetailStore click below Link to verify you account</p>
<a href='.$link.'></a>
$link
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@aasksoft.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);

}

?>