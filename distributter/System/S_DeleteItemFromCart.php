<?php

session_start();
require_once '../DataBase/DBConnection.php';
$email = $_SESSION['loginEmail'];
//$netAmount=0;
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}
$var=0.0;
$netAmount = 0;
$email = $_SESSION['loginEmail'];
$result=$mysqli_object->query("select `vat` from shopvat where shopemail='$email'");
if($row=$result->fetch_assoc())
{
    $vat=$row['vat'];
}
if($mysqli_object->query("update rstock set qty=qty+'".removeNoice('qty')."' where  stockid='".removeNoice('barcode')."'  and shopemail='$email'")==true && $mysqli_object->query("DELETE FROM `rkart` WHERE shopemail='$email' and barcode='".removeNoice('barcode')."'"))
{
    ?>
            <script>alert("Re Store <?php echo removeNoice('barocde'); ?> at stock on <?php echo removeNoice('qty'); ?> ");</script>
            <?php
          require_once 'S_TableDisplay.php';
}
else
{
    ?>
            <script>alert("Error on Re Store <?php echo removeNoice('barcode'); ?> to stock at <?php echo removeNoice('qty'); ?> ");</script>
            <?php
    require_once 'S_TableDisplay.php';
}
