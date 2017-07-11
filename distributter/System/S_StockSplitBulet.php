<?php
session_start();
$totalCount=0;
$splitcount=0;
$start=$_POST['start'];
$end=$_POST['end'];
$newStart=0;
$newEnd=0;
$divn=50;
require_once '../DataBase/DBConnection.php';
if (!isset($_SESSION['loginEmail'])) {
    header("Location: index.php");
}
$email=$_SESSION['loginEmail'];
 $result = $mysqli_object->query("select count(stockid) from rstock where shopemail='$email'");
 if($row=$result->fetch_assoc())
 {
     $totalCount=(int)$row['count(stockid)'];
     $splitcount=$totalCount/$divn;
 }
?>
<div id="stockin">
    
    <center><img src="One Moment Please Star Loader.gif" alt="" width="200px" height="200px"  id="loading"/></center>
<div class="" id="oldstock">
                                    
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>ITEM'S</th>
                                                <th>BRAND</th>
                                                <th style="width: 80px">SIZE</th>
                                                <th style="width: 40px">QTY</th>
                                                <th style="width: 40px">POP UP</th>
                                                <th style="width: 40px">RATE</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $newStart=$end;
                                            $newEnd=$end+$divn;
                                            
                                            $result = $mysqli_object->query("select * from rstock where shopemail='$email' limit $start,$end");
                                            while ($row = $result->fetch_assoc()) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['item']; ?></td>
                                                    <td><?php echo $row['brand']; ?></td>
                                                    <td><span class="badge bg-blue"><?php echo $row['size'] . "  "; ?><?php echo $row['unit']; ?></span></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td><?php echo $row['popup']; ?></td>
                                                    <td><?php echo $row['price']; ?></td>
                                                </tr>

                                                <?php $i++;
                                            }
                                            ?>

                                        </table>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer clearfix">
                                      <ul class="pagination pagination-sm no-margin pull-right">
                                       <?php
                                         if((int)$start===0)
                                         {
                                            echo ' <li><a href="#">&laquo;</a></li>';
                                         }
                                         else 
                                         {
                                             
                                             $psart=$start-$divn;
                                             $pend=$end-$divn;
                                             echo ' <li><a href="javascript:void('.$psart.','.$pend.')" onclick=display('.$psart.','.$pend.')>&laquo;</a></li>';
                                         }
                                         $current=$end/$divn;
                                       ?>
                                       
                                          <li><a href="#" ><?php echo $current;?></a></li>
                                        
                                        <?php
                                       
                                         if((int)$end==$totalCount || $end>$totalCount)
                                         {
                                            echo ' <li><a href="#">&raquo;</a></li>';
                                         }
                                         else 
                                         {
                                             echo ' <li><a href="javascript:void('.$newStart.','.$newEnd.')" onclick=display('.$newStart.','.$newEnd.')>&raquo;</a></li>';
                                         }
                                       ?>
                                      </ul>
                                        <p>&laquo;
                                            <?php
                                            $i=1;
                                            $j=1;
                                            echo " ";
                                            while($i<=$totalCount)
                                            {
                                                echo $j." ";
                                                $i=$i+$divn;
                                                $j++;
                                            }
                                            ?>
                                            &raquo;
                                        </p>
                                    </div>

                                </div>
    </div>