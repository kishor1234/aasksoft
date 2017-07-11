<?php

session_start();
require_once '../DataBase/DBConnection.php';
$email = $_SESSION['loginEmail'];
$netAmount=0;
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}
$var=0.0;

$email = $_SESSION['loginEmail'];
$result=$mysqli_object->query("select `vat` from shopvat where shopemail='$email'");
if($row=$result->fetch_assoc())
{
    $vat=$row['vat'];
}
$result=$mysqli_object->query("SELECT * FROM `rkart` WHERE shopemail='$email'");
$flag=0;
$count=$result->num_rows;
while($row=$result->fetch_assoc())
{
    if($mysqli_object->query("update rstock set qty=qty+'".$row['qty']."' where barcode='".$row['barcode']."' and shopemail='$email'")==true && $mysqli_object->query("DELETE FROM `rkart` WHERE shopemail='$email' and barcode='".$row['barcode']."'"))
    {
        $flag++;
    }
}
if($flag==$count)
{
   ?>
            <script>alert("All Item's From Cart Deleted Successfully");</script>
            <?php
            require_once 'S_TableDisplay.php';
}
else
{
    ?>
            <script>alert("Error on Cart Clearting ");</script>
            <?php
             require_once 'S_TableDisplay.php';
}

