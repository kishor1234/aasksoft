<?php
session_start();
require_once '../DataBase/DBConnection.php';
$email = $_SESSION['loginEmail'];
$number = removeNoice("stockid");
$i = 0;
$num = removeNoice('barcode');
$item=  removeNoice('item');
if (strcmp($num, "") == 0) {
    
} else {
    $n2 = "";
    ;
    for ($i = 0; $i < strlen($num) - 1; $i++) {
        $n2.=$num[$i];
    }
    ?>
<a href="#printBarcode" onclick="printBarocde('<?php echo $item;?>','System/phpbarcode/barcode_en.php?code=<?php echo $n2; ?>&encoding=EAN&scale=4&mode=png')"><img src="System/phpbarcode/barcode_en.php?code=<?php echo $n2; ?>&encoding=EAN&scale=4&mode=png" width="100px" /></a>
    <?php
}

function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}
try {
    $mysqli_object->query("UPDATE `rstock` SET barcode='$num' where shopemail='$email' and item='" . removeNoice('item') . "' and stockid='" . removeNoice('stockid') . "'");
    /*$resul = $mysqli_object->query("select * from rstock where shopemail='$email' and item='" . removeNoice('item') . "'");
    if ($row = $resul->fetch_assoc()) {
        if (strcmp($row["barcode"], "") == 0) {
            $mysqli_object->query("UPDATE `rstock` SET barcode='$dbSaveBarcodeNumber' where shopemail='$email' and item='" . removeNoice('item') . "'");
        }
    }*/
} catch (Exception $ex) {
    
}
?>
