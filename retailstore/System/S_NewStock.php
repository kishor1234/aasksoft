<?php
session_start();
require_once 'EncandDec.php';
require_once '../DataBase/DBConnection.php';
$flag = false;
$encdec = new EncandDec();
$msg="";
$email=$_SESSION['loginEmail'];
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}
//if(isset($_POST['save']))
//{
    try
    {
        if($mysqli_object->query("INSERT INTO `rstock`(`shopemail`, `item`, `brand`, `size`, `unit`) VALUES('" .$email . "','" . removeNoice('inputItem') . "','" . removeNoice('inputBrand') . "','" . removeNoice('inputSize') . "','" . removeNoice('inputUnit') . "')")==true)
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
