<?php
session_start();
require_once 'DataBase/DBConnection.php';
$email = "";
if (!isset($_SESSION['loginEmail'])) {
    header("Location: index.php");
}
$vat=0.0;
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
                        Sell Items
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li >Sell Items</li>
                        <li class="active">Sell</li>
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
                                                    <button type="submit" name="submit" class="btn btn-info pull-right" id="scanbutton" onclick="return getProduct()">Get Product</button>
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
                                
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Cart item's</h3>

                                    </div>
                                    <div class="box-body" id="itemInKart">
                                        <?php
                                        echo '<table class="table table-bordered">
                   <tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 150px">Items</th>
                      <th style="width: 40px">Qty</th>
                      <th style="width: 40px">Rate</th>
                      <th style="width: 40px">Net Rate</th>
                      <th style="width: 40px">Vat</th>
                      <th style="width: 40px">Vat Amount</th>
                      <th style="width: 40px">Total Price</th>
                      <th style="width: 40px">User Action</th>
                    </tr>';
                                        $rc = $mysqli_object->query("select * from rkart where shopemail='$email'");
                                        $i = 1;
                                        while ($row = $rc->fetch_assoc()) {
                                             //(float)$vatamount=(float)$row['totalprice']*(float)$row['vat']/100;
                                              //  (float)$total=$vatamount+(float)$row['totalprice'];
                                            echo'<tr>
                      <td>' . $i . '</td>
                      <td>' . $row['item'] . '</td>
                      <td>
                        ' . $row['qty'] . '
                      </td>
                      <td><span class="badge bg-blue">' . $row['rate'] . '</span></td>
                      <td><span class="badge bg-blue">' . $row['totalprice'] . '</span></td>
                          <td><span class="badge bg-blue">' . $row['vat'] . ' %</span></td>
                              <td><span class="badge bg-blue">' . $row['vatamt'] . '</span></td>
                                  <td><span class="badge bg-blue">' . $row['grandtotal'] . '</span></td>
                          <td><a href="javascript:void(0)" onclick="deleteItemFromCart(' . $row['barcode'] . ',' . $row['qty'] . ')" style="color:red;" class="btn btn-default btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                   

</tr>';
                                            $netAmount = $netAmount + (float)$row['grandtotal'];
                                           
                                        }
                                        
                                        /*$vatamt=$netAmount*$vat;
                                        $vatamt=$vatamt/100;
                                        $totalAmount=$netAmount+$vatamt;
                                        echo $vatamt;
                                        
                                        echo($totalAmount);*/
                                        echo'</table>';
                                        
                                        ?>
                                        <h1 style="float:right; color: #0063dc; padding-right: 75px;" id="cartTotalAmount"><label style="color:#000;">Total Amount: </label><strong>&nbsp;&nbsp;&nbsp;<?php echo $netAmount;?></strong></h1>
                                        <br><br><br>
                                        <div class="box-footer" id="printBill">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Billing Detail for User</h3>
                                                <a href="javascript:void(0)" onclick="closeBillingUserDetail()" style="float: right;" title="Close OR Hide"><i class="fa fa-angle-down" aria-hidden="true"></i></a>

                                            </div><!--action="System/S_BarcodeScanforUpdatStock.php" method="post"-->
                                            <form class="form-horizontal" id="scanner" name="scanner" action="#" method="post">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="inputCustomerName"  class="col-sm-2 control-label">Customer Name <span id="required">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="inputCustomerName" name="inputCustomerName" placeholder="Customer Name " required="">
                                                        </div>
                                                        <label for="inputCustomerEmail"  class="col-sm-2 control-label">Customer Email</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="inputCustomerEmail" name="inputCustomerEmail" placeholder="Customer Email " >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputCustomerMobile"  class="col-sm-2 control-label">Mobile<span id="required">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="inputCustomerMobile" name="inputCustomerMobile" maxlength="10" pattern="^\d{10}$" placeholder="Mobile "  required="">
                                                        </div>
                                                        <label for="inputNetAmount"  class="col-sm-2 control-label">NetAmount<span id="required">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="inputNetAmount" name="inputNetAmount" value="<?php echo $netAmount; ?>" placeholder="NetAmount" required="" readonly="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputCustomerMobile"  class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-4">

                                                        </div>
                                                        <label for="inputVat"  class="col-sm-2 control-label">Vat(<?php echo $vat;?>%)<span id="required">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="inputVat" name="inputVat" placeholder="Vat" value="<?php echo $vat; ?>"  required="" readonly="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputCustomerMobile"  class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-4">

                                                        </div>
                                                        <label for="inputTotalAmount"  class="col-sm-2 control-label">Total Amount<span id="required">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" id="inputTotalAmount" name="inputTotalAmount" placeholder="Total" value=""  required="" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer with-border">
                                                    </div>                                           

                                                    <div class="form-group">
                                                        <label for="inputCustomerMobile"  class="col-sm-8 control-label"></label>

                                                        <div class="col-sm-4">
                                                            <button  name="submit" class="btn btn-info pull-right" id="billPrnt" onclick="return billPrint()">Print</button>
                                                        </div>
                                                    </div>

                                                </div><!-- /.box-body -->

                                            </form>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer clearfix" id="cart_info">
                                        <ul class="pagination pagination-sm no-margin pull-right ">
                                            <li><a href="javascript:void(0)" onclick="userDetailShow()">Print Bill</a></li>
                                            <li><a href="javascript:void(0)" onclick="CleartKart()" style="color: red;">Clear Cart</a></li>

                                        </ul>
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
                                        <h3 class="box-title">Search Project By ID</h3>

                                    </div>
                                    <input type="text" class="form-control" id="SearchKeyWord" onkeyup="return search()">
                                    <div id="searchresult">
                                         <table class="table table-bordered">
                                    <tr>
                                      <th style="width: 10px">Product ID</th>
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
                                        <td><?php echo $row['product_id']?></td>
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
               

                

                <?php
                require_once 'Layout/DashboardScriptLink.php';
                ?>

                </body>
                </html>
