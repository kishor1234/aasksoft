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
    $query = "select * from rstock where shopemail='" . $email . "' and product_id like '%" . removeNoice('keywork') . "%'";
    $result = $mysqli_object->query($query);
    if($result->num_rows!=0)
    {
        echo "<table class='table'>";
        echo   "<th style='width: 10px'>Product ID</th>
                                      <th>Items</th>
                                      <th>Qty</th></tr>";
        //echo "<tr>";
        while($row=$result->fetch_assoc())
        {
           // $alink='<a href="javascript:void(0)" onclick="return selectProduct('$row[Product_ID]')">';
            ?>
            <tr>
            <td><a href="javascript:void(0)" onclick="return selectProduct('<?php echo $row["Product_ID"];?>')"> <?php echo $row['Product_ID'];?> </a></td>
                                        <td> <?php echo $row['item'];?></td>
                                        <td> <?php echo $row['qty'];?></td></tr>
        <?php
        
        }
    //echo"</tr>";
    echo "</table>";
    //echo $html;
    }
 else {
        echo "No Data Foune!..";
                
    }
} catch (Exception $ex) {
    
}