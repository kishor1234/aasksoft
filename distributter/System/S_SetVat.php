<?php
session_start();
require_once '../DataBase/DBConnection.php';
$email = $_SESSION['loginEmail'];


function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

if($mysqli_object->query("UPDATE `shopvat` SET `vat`='".  removeNoice("vat")."' WHERE `shopemail`='$email'")==true)
{
    echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Sucess</strong> New VAT Updated Sucessfully
</div>';
}
 else {
    
echo'<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh snap!</strong> Error on Update VAT try again...
</div>';

 }

