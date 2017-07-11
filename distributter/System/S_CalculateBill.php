<?php


session_start();
require_once '../DataBase/DBConnection.php';
$email = $_SESSION['loginEmail'];
$billid="";
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

try
{
    $restult=$mysqli_object->query("call lastbillid('$email','".removeNoice("inputCustomerName")."','".removeNoice("inputCustomerEmail")."','".removeNoice("inputCustomerMobile")."','".removeNoice("inputNetAmount")."','".removeNoice("inputVat")."','".removeNoice("inputTotalAmount")."')");
    if($row=$restult->fetch_assoc())
    {
        $billid=$row["MAX(id)"];
        echo '<center><a onclick="location.reload()" href="print.php?id='.$billid.'" class="btn btn-success" target="main">print</a><center>';
        $mysqli_object->close();
        $mysqli_object=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
        $restult=$mysqli_object->query("select * from rkart where shopemail='$email'");
       
        while($row=$restult->fetch_assoc())
        {
            $mysqli_object->query("INSERT INTO `sellbilldetail`(`id`, `shopemail`, `item`, `qty`, `rate`, `totalprice`, `vat`, `vatamt`, `grandtotal`) VALUES ('$billid','$email','".$row['item']."','".$row['qty']."','".$row['rate']."','".$row['totalprice']."','".$row['vat']."','".$row['vatamt']."','".$row['grandtotal']."')");

        }
        $mysqli_object->query("DELETE FROM rkart WHERE shopemail='$email'");
    }
    
} catch (Exception $ex) {

}