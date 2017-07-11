<?php
session_start();
require_once 'DataBase/DBConnection.php';
$email = "";
if (!isset($_SESSION['loginEmail'])) {
    header("Location: index.php");
}
$var=0.0;
$netAmount = 0;
$email = $_SESSION['loginEmail'];
$result=$mysqli_object->query("select `vat` from shopvat where shopemail='$email'");
if($row=$result->fetch_assoc())
{
    $vat=$row['vat'];
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
    <style>
        #printBill{
            display:none;
        }
    </style>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            require_once 'Layout/Header.php';
            require_once 'Layout/SideBar.php';
            ?>
             <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Sell Dublicate Bill
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li >Sell Dublicate Bill</li>
                        <li class="active">Bill</li>
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
                                        <h3 class="box-title">Get Product Detail using Barcode</h3>
                                        <h3 style="float:right; color: #0063dc;" id="cartTotalAmount"></h3>
                                    </div><!--action="System/S_BarcodeScanforUpdatStock.php" method="post"-->
                                    <form class="form-horizontal" id="scanner" name="scanner" action="#" method="post" >
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputBarcodeScane"  class="col-sm-2 control-label">Barcode</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="inputBarcodeScane" name="inputBarcodeScane" placeholder="Barcode " autofocus="" required="">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right" id="scanbutton" onclick="return getDublicateBill()">Get Bill</button>
                                                </div>
                                            </div>


                                        </div><!-- /.box-body -->

                                    </form>

                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                
                                <div class="box box-info" style=" height: 50%;">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Bill item's</h3>
<div id="oldBillDetail">
                                        
                                    </div>
                                    </div>
                                   
                                    
                                    <img src="One Moment Please Star Loader.gif" alt="" width="200px" height="200px"  id="loading"/>
                                    
                                
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
                        <div class="row" style="height:200px;">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Exceed Stock Limit</h3>

                                    </div>
                                    <table class="table table-bordered">
                                    <tr>
                                      <th style="width: 10px">#</th>
                                      <th>Items</th>
                                      <th>Qty</th>
                                      
                                    </tr>
                                    <?php
                                    $i=1;
                                    $result=$mysqli_object->query("SELECT * FROM `rstock` WHERE  shopemail='$email'");
                                    while($row=$result->fetch_assoc())
                                    {
                                        if((int)$row['qty']<=(int)$row['popup'])
                                        {
                                           ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row['item'];?></td>
                                        <td><?php echo $row['qty'];?></td>
                                    </tr>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                    </table>


                                </div>

                            </div>

                        </div>
                    </div>
                    <!--</div>-->
                </section>


                <?php
                require_once 'Layout/Footer.php';
                ?>
                 <script src="bootstrap/js/aasksoft.js" type="text/javascript"></script>
               
                <?php
                require_once 'Layout/DashboardScriptLink.php';
                ?>

                </body>
                </html>