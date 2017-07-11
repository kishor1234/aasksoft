<?php
session_start();
require_once 'DataBase/DBConnection.php';
if (!isset($_SESSION['loginEmail'])) {
    header("Location: index.php");
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
                        Barcode Generate
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li >Barcode</li>
                        <li class="active">Generate</li>
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
                                    <div class="box-body">
                                        <table class="col-md-12 table-bordered">
                                            <tr>
                                                <th style="width: 20px auto;">#</th>
                                                <th>ITEM'S</th>
                                                <th>BRAND</th>
                                                <th style="width: 20px auto; height: 30px auto; ">SIZE</th>
                                                <th style="width: 20px auto; height: 30px auto;">QTY</th>

                                                <th style="width: 20px auto; height: 30px auto; ">RATE</th>
                                                <th style="width: 20px auto; height: 30px auto;">Generate</th>
                                                <th style="width: 20px auto; height: 30px auto;">Use Company Barcode</th>
                                                <th style="width: 20px auto; height: 30px auto;">Barcode</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $result = $mysqli_object->query("select * from rstock where shopemail='$email'");
                                            while ($row = $result->fetch_assoc()) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['item']; ?></td>
                                                    <td><?php echo $row['brand']; ?></td>
                                                    <td><span class="badge bg-blue"><?php echo $row['size'] . "  "; ?><?php echo $row['unit']; ?></span></td>
                                                    <td><?php echo $row['qty']; ?></td>

                                                    <td><?php echo $row['price']; ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="setNewBarcode('<?php echo $row['stockid']; ?>', '<?php echo $row['item']; ?>')" class="btn btn-primary btn-xs">Generate</a>
                                                    </td>
                                                    <td>
                                                        <a href="#setCompanyBarcode" onclick="setCompanyBarcode('<?php echo $row['stockid']; ?>', '<?php echo $row['item']; ?>')" class="btn btn-primary btn-xs">Company</a>
                                                    </td>
                                                    <td>

                                                        <div id="<?php echo $row['stockid']; ?>">
                                                            <?php
                                                            $i = 0;
                                                            $num = $row['barcode'];
                                                            if (strcmp($num, "") == 0) {
                                                                
                                                            } else {
                                                                $n2 = "";
                                                                ;
                                                                for ($i = 0; $i < strlen($num) - 1; $i++) {
                                                                    $n2.=$num[$i];
                                                                }
                                                                ?>
                                                            <a href="#printBarcode" onclick="printBarocde('<?php echo $row['item'];?>','System/phpbarcode/barcode_en.php?code=<?php echo $n2; ?>&encoding=EAN&scale=4&mode=png')"><img src="System/phpbarcode/barcode_en.php?code=<?php echo $n2; ?>&encoding=EAN&scale=4&mode=png" width="100px" /></a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                </tr>

    <?php
    $i++;
}
?>

                                        </table>
                                    </div><!-- /.box-body -->
                                    <!--<div class="box-footer clearfix">
                                      <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                      </ul>
                                    </div>-->

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

