<?php
session_start();
require_once 'MailSend.php';
require_once 'EncandDec.php';
require_once '../DataBase/DBConnection.php';
$flag = false;
$encdec = new EncandDec();
$link="";
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

if (isset($_POST['submit'])) {
    $ip = "";
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $date=date("Y-m-d", strtotime('+1 years'));
 
 try
 {
    // die("INSERT INTO `shopes`(`email`, `password`, `shoptype`, `shopname`,`mobile`, `address`, `country`,`state`,`district`,`city`,`pin`,`registerip`, `enddate`, `emailvarification`) VALUES ('" . removeNoice('inputEmail') . "','" .md5(removeNoice('inputPassword')). "','" . removeNoice('shopType') . "','" . removeNoice('inputShopName') . "','" . removeNoice('inputMobileNumber') . "','" . removeNoice('address') . "','" . removeNoice('country') . "','" . removeNoice('state') . "','" . removeNoice('district') . "','" . removeNoice('city') . "','" . removeNoice('pin') . "','$ip','$date','0')");
   if ($mysqli_object->query("INSERT INTO `shopes`(`email`, `password`, `shoptype`, `shopname`,`mobile`, `address`, `country`,`state`,`district`,`city`,`pin`,`registerip`, `enddate`, `emailvarification`) VALUES ('" . removeNoice('inputEmail') . "','" .md5(removeNoice('inputPassword')). "','" . removeNoice('shopType') . "','" . removeNoice('inputShopName') . "','" . removeNoice('inputMobileNumber') . "','" . removeNoice('address') . "','" . removeNoice('country') . "','" . removeNoice('state') . "','" . removeNoice('district') . "','" . removeNoice('city') . "','" . removeNoice('pin') . "','$ip','$date','0')") == true) {
        $flag = true;
        $mysqli_object->query("INSERT INTO `shopvat`(`shopemail`) VALUES ('" . removeNoice('inputEmail') . "')");
        $email=$encdec->base64url_encode(removeNoice('inputEmail'));
        
        $link="http://retailstore.aasksoft.com/verify.php?id='$email'";
        mailSend(removeNoice('inputEmail') , $link);
        
    }  
 } catch (Exception $ex) {
     echo $ex;
 }
    
}
?>
<html>
    <head>
        <title>New Shop Registration</title>
        <link href="../../JobPortal/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <center>
<?php
if ($flag == true) {
    echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> You successfully Register, Check your Email and  Verify  Accoutn... 
</div><br>
<!--<a href='.$link.'>Varification</a>-->
<a href="../index.php" class="alert-link btn tbn-primary">Login </a>';
} else {
    echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh snap!</strong> <a href="../Register.php" class="alert-link">Register</a> Try again leter
</div>';
}
?>
    </center>
</body>
</html>