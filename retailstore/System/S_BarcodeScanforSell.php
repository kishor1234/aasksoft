<?php
session_start();
require_once '../DataBase/DBConnection.php';
$email = $_SESSION['loginEmail'];

function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

try {
    $var = 0.0;
    $netAmount = 0;
    $email = $_SESSION['loginEmail'];
    $result = $mysqli_object->query("select `vat` from shopvat where shopemail='$email'");
    if ($row = $result->fetch_assoc()) {
        $vat = $row['vat'];
    }
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
    $query = "select * from rstock where shopemail='" . $email . "' and barcode='" . removeNoice('inputBarcodeScane') . "'";
    $result = $mysqli_object->query($query);
    if($result->num_rows!=0)
    {
        if ($row = $result->fetch_assoc()) {
        //conter to string to int
        //echo strcmp($row['qty'], $row['popup']);
        if ((int) $row['qty'] < (int) $row['popup']) {
            ?>
            <script>alert("Item Less then popup current stock item count is  <?php echo $row['qty']; ?>");</script>
            <?php
            if ((int) $row['qty'] == 0) {

                require_once 'S_TableDisplay.php';
                ?>
                <script>alert("Selected Item is not in stock please update stock");</script>
                <?php
            } else {
                //popup
                $secondResult = $mysqli_object->query("select * from rkart where barcode='" . removeNoice('inputBarcodeScane') . "'");
                // echo "select * from rkart where barcode='" . removeNoice('inputBarcodeScane') . "'";
                if ($row1 = $secondResult->fetch_assoc()) {
                    if ($mysqli_object->query("update rkart set qty=qty+'1' ,totalprice=totalprice+'" . $row['price'] . "' where barcode='" . removeNoice('inputBarcodeScane') . "'") == true && $mysqli_object->query("update rstock set qty=qty-1 where barcode='" . removeNoice('inputBarcodeScane') . "'") == true) {
                        require_once 'S_TableDisplay.php';
                        //display
                    }
                } else {
                    if ($mysqli_object->query("INSERT INTO `rkart`(`shopemail`, `item`, `qty`, `rate`, `totalprice`, `ipaddress`,`barcode`) VALUES ('$email','" . $row['item'] . "','1','" . $row['price'] . "','" . $row['price'] . "','$ip','" . removeNoice('inputBarcodeScane') . "')") == true && $mysqli_object->query("update rstock set qty=qty-1 where barcode='" . removeNoice('inputBarcodeScane') . "'") == true) {
                        //table
                        require_once 'S_TableDisplay.php';
                    }
                }
            }
        } else {
            $secondResult = $mysqli_object->query("select * from rkart where barcode='" . removeNoice('inputBarcodeScane') . "'");
            // echo "select * from rkart where barcode='" . removeNoice('inputBarcodeScane') . "'";
            if ($row1 = $secondResult->fetch_assoc()) {
                if ($mysqli_object->query("update rkart set qty=qty+'1' ,totalprice=totalprice+'" . $row['price'] . "' where barcode='" . removeNoice('inputBarcodeScane') . "'") == true && $mysqli_object->query("update rstock set qty=qty-1 where barcode='" . removeNoice('inputBarcodeScane') . "'") == true) {
                    //display
                    require_once 'S_TableDisplay.php';
                }
            } else {
                if ($mysqli_object->query("INSERT INTO `rkart`(`shopemail`, `item`, `qty`, `rate`, `totalprice`, `ipaddress`,`barcode`) VALUES ('$email','" . $row['item'] . "','1','" . $row['price'] . "','" . $row['price'] . "','$ip','" . removeNoice('inputBarcodeScane') . "')") == true && $mysqli_object->query("update rstock set qty=qty-1 where barcode='" . removeNoice('inputBarcodeScane') . "'") == true) {

                    require_once 'S_TableDisplay.php';
                }
            }
        }
    } else {
        $secondResult = $mysqli_object->query("select * from rkart where barcode='" . removeNoice('inputBarcodeScane') . "'");
        if ($row1 = $secondResult->fetch_assoc()) {
            if ($mysqli_object->query("update rkart set qty=qty+'1' ,totalprice=totalprice+'" . $row['price'] . "' where barcode='" . removeNoice('inputBarcodeScane') . "'") == true && $mysqli_object->query("update rstock set qty=qty-1 where barcode='" . removeNoice('inputBarcodeScane') . "'") == true) {
                require_once 'S_TableDisplay.php';
                //display
            }
        } else {
            if ($mysqli_object->query("INSERT INTO `rkart`(`shopemail`, `item`, `qty`, `rate`, `totalprice`, `ipaddress`,`barcode`) VALUES ('$email','" . $row['item'] . "','1','" . $row['price'] . "','" . $row['price'] . "','$ip','" . removeNoice('inputBarcodeScane') . "')") == true && $mysqli_object->query("update rstock set qty=qty-1 where barcode='" . removeNoice('inputBarcodeScane') . "'") == true) {
                //table
                require_once 'S_TableDisplay.php';
            }
        }
    }
    }
 else {
         require_once 'S_TableDisplay.php';
                
    }
} catch (Exception $ex) {
    
}