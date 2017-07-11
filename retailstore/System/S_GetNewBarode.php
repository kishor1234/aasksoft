<?php
session_start();
require_once '../DataBase/DBConnection.php';
$email=$_SESSION['loginEmail'];
$number=removeNoice("stockid");
$number_length=  strlen($number);
$newNumbe="0";
$item=removeNoice('item');
$len=12;
if((int)$number_length<=$len)
{
    if((int)$number_length==$len)
    {
       $newNumbe=$number; 
    }
 else {
        $diff=$len-$number_length;
        for($i=1;$i<$diff;$i++)
        {
        $newNumbe.="0";
        }
        $newNumbe.=$number;
        //echo $diff."<br>";
    }
    
}
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}
$ean_checksum2= ean_checksum2($newNumbe);
$dbSaveBarcodeNumber=$newNumbe;
$dbSaveBarcodeNumber.=$ean_checksum2;
function ean_checksum2($ean){
  $ean=(string)$ean;
  $even=true; $esum=0; $osum=0;
  for ($i=strlen($ean)-1;$i>=0;$i--){
	if ($even) $esum+=$ean[$i];	else $osum+=$ean[$i];
	$even=!$even;
  }
  
  return (10-((3*$esum+$osum)%10))%10;
}
try
{
    $resul=$mysqli_object->query("select * from rstock where shopemail='$email' and item='".  removeNoice('item')."'");
    if($row=$resul->fetch_assoc())
    {
        if(strcmp($row["barcode"],"")==0)
        {
          $mysqli_object->query("UPDATE `rstock` SET barcode='$dbSaveBarcodeNumber' where shopemail='$email' and item='".  removeNoice('item')."' and stockid='" . removeNoice('stockid') . "'");
          
        }
        else
        {
          $mysqli_object->query("UPDATE `rstock` SET barcode='$dbSaveBarcodeNumber' where shopemail='$email' and item='".  removeNoice('item')."' and stockid='" . removeNoice('stockid') . "'");
          
        }
    }
} catch (Exception $ex) {

}

?>
<a href="#printBarcode" onclick="printBarocde('<?php echo $item;?>','System/phpbarcode/barcode_en.php?code=<?php echo $number; ?>&encoding=EAN&scale=4&mode=png')"><img alt="The Real David Tufts" src="System/phpbarcode/barcode_en.php?code=<?php echo $number;?>&encoding=EAN&scale=4&mode=png" width="100px" /></a>
