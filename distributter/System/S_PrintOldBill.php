<?php 
session_start();
function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}
require_once '../DataBase/DBConnection.php';

$email = $_SESSION['loginEmail'];
$billid=$_POST['id'];
$shopname="";
$address="";
$netAmount="";
$vatamt="";
$totalAmount="";
$name="";
$date="";
$result=$mysqli_object->query("SELECT * FROM shopes WHERE email='$email'");
$vat="";
if($row=$result->fetch_assoc())
{
    $shopname=$row['shopname'];
    $address=$row['address'];
}
$result=$mysqli_object->query("select `vat` from shopvat where shopemail='$email'");
if($row=$result->fetch_assoc())
{
    $vatamt=$row['vat'];
}
?> 

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Bill NO.<?php echo $billid;?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <style>
            #allSideBorder
            {
                border: 2px solid #000;
            }
            .watermark {
                        opacity: 0.5;
                        color: BLACK;
                        position: fixed;
                        top: auto;
                        left: 80%;
                    }
        </style>
    </head>
    <body onload="window.print()">
     <div class="watermark">
           Sample Watermark
    </div>
        <div>
          
            <center>
                <h3><strong><?php echo $shopname;?></strong></h3>
                    <address>
                        <?php echo $address;?>
                    </address>
            </center>
              <?php
                $result=$mysqli_object->query("select * from rstoreinvoice where id='$billid' and shopemail='$email'");
                
                if($row=$result->fetch_assoc())
                {
                    $name=$row['name'];
                    $date=$row['billdate'];
                    $netAmount=$row['netamount'];
                    $vat=$row['vat'];
                    $totalAmount=$row['totalamount'];
                }
 else {
     echo "enter valid bill no";
 }
              ?>
                    <div>
                        <table style="width:100%;">
                            <tr>
                                <td><label>Name:</label></td>
                                <td><?php echo $name;?></td>
                                <td><label>Date:</label></td>
                                <td><?php echo $date;?></td>
                                <td>Bill NO.</td>
                                <td>
                                    <img  src="System/barcode/barcode.php?text=<?php echo $billid;?>&print=true"
                                </td>
                            </tr>
                        </table>
                        
                        
                    </div>
               
                
                <div>
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Price</th>
                        </tr>
                        <?php 
                        $i=1;
                        $result=$mysqli_object->query("select * from sellbilldetail where id='$billid'");
                        while($row=$result->fetch_assoc())
                        {
                            
                       
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['item'];?></td>
                            <td><?php echo $row['qty'];?></td>
                            <td><?php echo $row['rate'];?></td>
                            <td><?php echo $row['totalprice'];?></td>
                        </tr>
                       <?php
                       $i++;
                        } 
                        ?>
                        <tr>
                            <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        </tr>
                    </table>
                    <table style='width: 20%; float: right; margin-right: 1%;'>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>Net Amount</strong></td>
                            <td><h5 style="float:left;"><?php echo $netAmount;?></h5></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>Vat(<?php echo $vatamt;?>%)&nbsp;</strong></td>
                            <td><h5 style="float:left;"><?php echo $vat;?></h5></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>Total</strong></td>
                            <td><h5 style="float:left;"><?php echo $totalAmount;?></h5></td>
                        </tr>
                        </table>
                    <table style='width: 100%; float: left;'>
                        <tr>
                            
                            <td><h5 style="float:right; margin-right: 15%;">Amoutn in Word:- <strong><?php echo convert_number_to_words($totalAmount);?></strong></h5></td>
                            
                        </tr>
                    </table>
                    <div>
                        <h3>Note:-</h3>
                        <?php
                        $result=$mysqli_object->query("select `note` from `billnotes` where shopemail='$email'");
                        while($row=$result->fetch_assoc())
                        {
                            echo '<strong style="padding-left:60px;">'.$row['note'].'</strong><br>';
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
    <center>
        <a href="print.php?id=<?php echo $billid;?>" class="btn btn-success" target="main">Print</a>
    </center>
        
        <script src="js/jquery.1.11.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
