<?php
session_start();
$totalCount=0;
$splitcount=0;
$start=0;
$end=0;
$newStart=0;
$newEnd=0;
$divn=50;
require_once 'DataBase/DBConnection.php';
if (!isset($_SESSION['loginEmail'])) {
    header("Location: index.php");
}
$email=$_SESSION['loginEmail'];
 $result = $mysqli_object->query("select count(stockid) from rstock where shopemail='$email'");
 if($row=$result->fetch_assoc())
 {
     $totalCount=(int)$row['count(stockid)'];
     $splitcount=$totalCount/$divn;
     $end=$start+$splitcount;
 }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    require_once 'Layout/HeadeFileLinker.php';
    ?>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            require_once 'Layout/Header.php';
            require_once 'Layout/SideBar.php';
            
            ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        View Stock
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li >Stock</li>
                        <li class="active">View</li>
                    </ol>
                </section>
                <section class="content">
                    <!--<div class="row">-->
                    <div class="col-md-8">
                        <!--<section class="content">-->
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Stock Details</h3>

                                    </div>
                                    <div id="stockin">
                                        <center><img src="One Moment Please Star Loader.gif" alt="" width="200px" height="200px"  id="loading"/></center>
                                        <div class="" id="oldstock">
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
                                                                                      
                                            $end=$start+$divn;
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
                                         if($start===0)
                                         {
                                            echo ' <li><a href="#">&laquo;</a></li>';
                                         }
                                         else 
                                         {
                                             
                                             echo ' <li><a href="javascript:void(0)" onclick=display('.$start.','.$end.')>&laquo;</a></li>';
                                         }
                                         $current=$end/$divn;
                                       ?>
                                       
                                          <li><a href="#" ><?php echo $current;?></a></li>
                                        
                                        <?php
                                         if($end===$totalCount || $end>$totalCount)
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

                            </div>

                        </div>

                        <!--</section>-->
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"></h3>

                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                    <!--</div>-->
                </section>


                <?php
                require_once 'Layout/Footer.php';
                require_once 'Layout/DashboardScriptLink.php';
                ?>

                </body>
                </html>
