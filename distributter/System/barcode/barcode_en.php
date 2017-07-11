<?php
//autoload
include("ean.php");

class Barcode
{
   public $number;
   public $encoding;
   public $scale;

   protected $_encoder;

   function __construct($encoding, $number=null, $scale=null)
   {
      $this->number = ($number==null) ? $this->_random() : $number;
      $this->scale = ($scale==null || $scale<4) ? 4 : $scale;

      // Reflection Class : Method

      $this->_encoder = new EAN13($this->number, $this->scale);
   }

   function __destruct()
   {
      $this->_encoder->display();
   }

   private function _random()
   {
     return substr(number_format(time() * rand(),0,'',''),0,12);
   }
}

$encoding = (isset($_GET['encoding'])) ? $_GET['encoding'] : 'EAN-13';
$number   = (isset($_GET['code']))     ? $_GET['code']     : null;
$scale    = (isset($_GET['scale']))    ? $_GET['scale']    : null;
$len=12;
$number_length=  strlen($number);
$newNumbe="0";
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
 //echo "NewNumber:- ".$newNumbe."<br>";
 
//echo ean_checksum2($newNumbe);
function ean_checksum2($ean){
  $ean=(string)$ean;
  $even=true; $esum=0; $osum=0;
  for ($i=strlen($ean)-1;$i>=0;$i--){
	if ($even) $esum+=$ean[$i];	else $osum+=$ean[$i];
	$even=!$even;
  }
  
  return (10-((3*$esum+$osum)%10))%10;
}
new Barcode($encoding, $newNumbe, $scale);
//new Barcode($encoding, $number, $scale);
