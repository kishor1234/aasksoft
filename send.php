<?php
function  mailSend($email,$msg,$from,$mobile)
{
    $to = $email;
$subject = "Web Site Contact aasksoft limited ";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>".$msg."</br><br>
".$from."
</p>
<p>
<h3>Contact:-".$mobile."</h3>
</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <'.$to.'>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail("info@aasksoft.com",$subject,$message,$headers);

$message2="
<html>
<head>
<title>HTML email</title>
</head>
<body>

<h1>Thanks for Visit us.... We Contact you Soon...</h1>
<img src='http://aasksoft.com/images/logo2.png' width='300' height='250'/><br>
<h3>Visit us: <a href='aasksoft.com'>@asksoft</a></h3>

</body>
</html>";

$headers2 = "MIME-Version: 1.0" . "\r\n";
$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers2 .= 'From: <info@aasksoft.com>' . "\r\n";
mail($to,"Thanks Your Visit",$message2,$headers2);
return true;
}

?>
<?php
if(isset($_POST['send']))
{
    
    $to = $_POST['email'];
    $subject =$_POST['subject'];
    $txt = $_POST['msg'];
    $from=$_POST['email'];
    $mobile=$_POST['inputMobile'];
    
    /*$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <no-replay@aasksoft.com>' . "\r\n";
   // $headers .= "From: <" .$from. ">\r\n" ;
   	
         */
         //die($txt);
         $message = "<b>Resp. Sir/Madam,</b><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
         $message .= $txt;
         $message.="<br><br>";
         $header = "From: " .$from. "\r\n" ;
       
         if( mailsend($to,$message,$from,$mobile)== true ) {
             echo "<script>alert('Request Message Send Successfully, We contact soon');</script>";
             echo "<script type='text/javascript'>
window.location.href = 'http://www.aasksoft.com/';
</script>";
         }else {
            echo "<script>alert('Problem on sending request please try again after some time...');</script>";
            echo "<script type='text/javascript'>
window.location.href = 'http://www.aasksoft.com/';
</script>";
         }
    
   
    
}
else
{
  echo "<script>alert('Problem on sending request please try again after some time...');</script>";
   echo "<script type='text/javascript'>
window.location.href = 'http://www.aasksoft.com/';
</script>";
  
}
?>