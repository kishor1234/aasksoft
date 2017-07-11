<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <center>
<?php

require_once 'System/EncandDec.php';
require_once 'DataBase/DBConnection.php';
$dec=new EncandDec();
$email=$dec->base64url_decode($_REQUEST['id']);
echo $email;
echo "update shopes set emailvarificaion='1' where email='$email'";
if($mysqli_object->query("update shopes set shopes.emailvarification='1' where email='$email'")==true)
{
    echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Well done!</strong> You successfully Register, Check your Email and  Verify  Accoutn... 
</div><br>

<a href="index.php" class="alert-link btn btn-success">Login </a>';
    
}
 else {
    echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh snap!</strong> Try again leter contact to System Admin
</div>';
 }
?>
    </center>
</body>
</html>