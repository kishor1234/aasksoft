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
require_once 'DataBase/DBConnection.php';

$email = $_SESSION['loginEmail'];
$billid=$_REQUEST['id'];
$shopname="";
$shoptype="";
$address="";
$netAmount="";
$vatamt="";
$totalAmount="";
$name="";
$date="";

$vat="";
$shoplogo="";

$result=$mysqli_object->query("select `vat` from shopvat where shopemail='$email'");
if($row=$result->fetch_assoc())
{
    $vatamt=$row['vat'];
}

                $result=$mysqli_object->query("select * from rstoreinvoice where id='$billid' and shopemail='$email'");
                
                if($row=$result->fetch_assoc())
                {
                    $name=$row['name'];
                    $mobile=$row['mobile'];
                    $cemail=$row['email'];
                    $date=$row['billdate'];
                    $netAmount=$row['netamount'];
                    $vat=$row['vat'];
                    $totalAmount=$row['totalamount'];
                }
$result=$mysqli_object->query("select * from shopes where email='$email'");
if($row=$result->fetch_assoc())
{
    
    $shopname=$row['shopname'];
    $address=$row['address'];
    $shoptype=$row['shoptype'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Tax INVOICE</title>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<link rel='stylesheet' type='text/css' href='bootstrap/css/style.css' />
	<link rel='stylesheet' type='text/css' href='bootstrap/css/print.css' media="print" />
	<script type='text/javascript' src='bootstrap/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='bootstrap/js/example.js'></script>

</head>

    <body onload="window.print()">

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		
                    <address>
               
                        <strong><?php echo $shopname.", ".$_SESSION['shoptype']."<br>"
                                . $row['address']."<br>".
                                "Dist: ". $row['district'].","."Tal: ". $row['city']."<br>".
                                "Pin: ". $row['pin']."<br>".
                                "";
                        echo 'Email: '.$email.'<br>';
                        echo 'Mobile No:'.$row['mobile'];
                        $shoplogo=$row['shoplogo'];
                        ?>
                            
                        </strong><br>
                            
               <?php
               }
?> 
                </address>

            <div id="logo">

              
                <img id="image" src="<?php echo $shoplogo;?>" alt="logo" width="100px" height="100px" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">
                    <strong>Name&nbsp;&nbsp;&nbsp;:&nbsp;</strong><?php echo $name;?></br>
                    <strong>Mobile&nbsp;:&nbsp;</strong><?php echo $mobile;?></br>
                    <strong>Email&nbsp;&nbsp;&nbsp;:&nbsp;</strong><?php echo $cemail;?></br>
            

            <table id="meta">
                <tr>
                    <td class="meta-head">Sr.no #</td>
                    <td><?php echo $billid;?><img  src="System/barcode/barcode.php?text=<?php echo $billid;?>&print=true"></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td id="date"><?php echo $date;?></td>
                </tr>
                <!--<tr>

                    <td class="meta-head">Your Ref:</td>
                   <td id="date"><?php echo "";?></td>
                </tr>
                <tr>

                    <td class="meta-head">Our Ref:</td>
                    <td id="date"><?php echo "";?></td>
                </tr>-->
                
               
            </table>
		
		</div>
		
		<table  id="items">
		
		  <tr>
                      <th style="width:50px;">#</th>
		      <th>Item</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Net Amount</th>
                      <th>Vat Percentage</th>
                      <th>Vat Amount</th>
                      <th>Total</th>
		  </tr>
		  <?php 
                        $i=1;
                        $result=$mysqli_object->query("select * from sellbilldetail where id='$billid'");
                        while($row=$result->fetch_assoc())
                        {
                            
                       
                        ?>
		  <tr>
                      <td><textarea><?php echo $i;?></textarea></td>
		      <td class="description"><textarea><?php echo $row['item'];?></textarea></td>
		      <td><textarea class="cost" readonly><?php echo $row['rate'];?>₹</textarea></td>
		      <td><textarea class="qty" readonly><?php echo $row['qty'];?></textarea></td>
		      <td><textarea class="price" readonly><?php echo $row['totalprice'];?>₹</textarea></td>
                      <td><textarea class="cost" readonly><?php echo $row['vat'];?>₹</textarea></td>
		      <td><textarea class="qty" readonly><?php echo $row['vatamt'];?></textarea></td>
		      <td><textarea class="price" readonly><?php echo $row['grandtotal'];?>₹</textarea></td>
		  </tr>
		  <?php
                       $i++;
                        } 
                        ?>
               
                  </table>
                  <table id="item" style="width:100%;"> 
		  <tr>
		    <td colspan="5">Amoutn in Word:- <strong><?php echo convert_number_to_words($totalAmount);?></strong></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank" style="width:300px; border-bottom-color: transparent;"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal"><strong><?php echo $netAmount;?>&nbsp;₹</strong></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank" style="border-bottom-color: transparent;"> </td>
		      <td colspan="2" class="total-line">VAT(<?php echo $vatamt;?>%)</td>
                      <td class="total-value"><div id="total" style="float:left;"><strong><?php echo $vat;?>&nbsp;₹</strong></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"  style=""> </td>
		      <td colspan="2" class="total-line balance">Total Amount</td>

		      <td class="total-value balance"><div id="paid"><strong><?php echo $totalAmount;?>&nbsp;₹</strong></div></td>
		  </tr>
                      
		  <!--<tr>
		      <td colspan="2" class="blank"  style="border:transparent;"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">875.00₹</div></td>
		  </tr>-->
		
		</table>
		
		<div id="terms">
		  <h5>Powered By www.aasksoft.com</h5>
		  <textarea>Terms and Condition of companies.</textarea>
		</div>
	
	</div>
	
</body>

</html>