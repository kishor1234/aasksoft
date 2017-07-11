<?php

$handle=  fopen('Book1.csv', 'r');
$c=1;
echo "<table>";
$flag=0;
while(($fileops=  fgetcsv($handle,1000,","))!=false)
{
    $item=$fileops[4];
    $brand=$fileops[5];
    $size=$fileops[6];
    $unit=$fileops[7];
    if($flag==0)
    {
        echo"<tr>"
        . "<th>$item</th>"
                . "<th>$brand</th>"
                . "<th>$size</th>"
                . "<th>$unit</th>"
                . "</tr>";
        $flag=1;
    }  else {
        echo"<tr>"
        . "<td>$item</td>"
                . "<td>$brand</td>"
                . "<td>$size</td>"
                . "<td>$unit</td>"
                . "</tr>";
    }
}
