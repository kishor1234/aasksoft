<?php
session_start();
require_once '../DataBase/DBConnection.php';
$email=$_SESSION['loginEmail'];
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

 try
    {
        if($mysqli_object->query("update rstock set qty=qty+'".  removeNoice('inputQuantity')."',popup='".  removeNoice('inputPopup')."',price='".  removeNoice('inputPrice')."' where barcode='".  removeNoice('inputBarcode')."'")==true)
        {
            $msg='<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> New Stock Successfully Save
</div>';
        }
        else
        {
           $msg='<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh snap!</strong> New Stock not Save now please try again.......
</div>'; 
        }
    } catch (Exception $ex) {
        $msg=$ex;
    }
    echo $msg;
//}
