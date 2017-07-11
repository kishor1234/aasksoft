<?php
session_start();
require_once 'EncandDec.php';
require_once '../DataBase/DBConnection.php';
include ("../Classes/PHPExcel/IOFactory.php"); 
$encdec = new EncandDec();
$email=$_SESSION['loginEmail'];
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{
    $ext=$_FILES["FileInput"]["type"];
    
    if(strcmp("application/vnd.ms-excel",$ext)==0)
    {
             $file=$_FILES["FileInput"]["tmp_name"];
      $html='<a href="javascript:void(0)" onclick="closew()" style="float: right; padding-right:10px;" title="Close OR Hide"><i class="fa fa-angle-down" aria-hidden="true"></i></a>';
 $html.="<table class='table'>";  
 $html.="<tr>"
         . "<th>#</th>"
         . "<th>Item's</th>"
         . "<th>Brand</th>"
         . "<th>Size</th>"
         . "<th>Unit</th>"
         . "<th>QTY</th>"
         . "<th>POPUP</th>"
         . "<th>PRICE</th>"
         . "</tr>";
         
 $objPHPExcel = PHPExcel_IOFactory::load($file);  
 $i=1;
 foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)   
 {  
      $highestRow = $worksheet->getHighestRow();  
      for ($row=2; $row<=$highestRow; $row++)  
      {  
           $html.="<tr>";  
           $productID = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); 
           $item = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
           $brand = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
           $size =  $worksheet->getCellByColumnAndRow(3, $row)->getValue(); 
           $unit =  $worksheet->getCellByColumnAndRow(4, $row)->getValue(); 
           $qty =  $worksheet->getCellByColumnAndRow(5, $row)->getValue(); 
           $popup =  $worksheet->getCellByColumnAndRow(6, $row)->getValue();
           $price =  $worksheet->getCellByColumnAndRow(7, $row)->getValue();
           $vat =  $worksheet->getCellByColumnAndRow(8, $row)->getValue();
           $result=$mysqli_object->query("SELECT * FROM `rstock` where shopemail='$email' and item='$item' or Product_ID='$productID'");
           
           if($result->num_rows===1)
           {
               if($mysqli_object->query("UPDATE `rstock` SET qty=qty+'$qty' , popup='$popup' ,price='$price',vat='$vat' where shopemail='$email' and item='$item'or Product_ID='$productID' ")==true);

           }
        else {
            if($mysqli_object->query("INSERT INTO `rstock`(`shopemail`, `product_id`,`item`, `brand`, `size`, `unit`, `qty`, `popup`,`price`,`vat`) VALUES('" .$email . "','".$productID."','" . $item . "','" . $brand . "','" . $size . "','" . $unit . "','" . $qty . "','" . $popup . "','" . $price . "','" . $vat . "')")==true);
     
        }
           
          // mysqli_query($connect, $sql);
           $html.= '<td>'.$i.'</td>'; 
           $html.= '<td>'.$item.'</td>';  
           $html .= '<td>'.$brand.'</td>';  
           $html .= '<td>'.$size.'</td>';  
           $html .= '<td>'.$unit.'</td>'; 
           $html .= '<td>'.$qty.'</td>'; 
            $html .= '<td>'.$popup.'</td>';
           $html .= '<td>'.$price.'</td>';
           $html .= "</tr>";  
           $i++;
      }  
      
 }  
 $html .= '</table>';  
 echo $html;  
 echo '<br /><div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <center>Import sucessfully!</center> 
</div>';  
}
else
{
    echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh!</strong> Choose only Excel Formated File .xls or use Templeat click on download button to get Template...
</div>';
}
    }
    else
    {
        echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh!</strong> Choose only Excel Formated File .xls or use Templeat click on download button to get Template...
</div>';
    }

