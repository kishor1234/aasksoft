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
                        Update Stock
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li >Stock</li>
                        <li class="active">Update</li>
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
                                        
                                    </div><!--action="System/S_BarcodeScanforUpdatStock.php" method="post"-->
                                    <form class="form-horizontal" id="scanner" name="scanner">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputBarcodeScane"  class="col-sm-2 control-label">Barcode</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="inputBarcodeScane" name="inputBarcodeScane" placeholder="Barcode" autofocus="" required="">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right" id="scanbutton" onclick="return getProduct2()">Get Product</button>
                                                </div>
                                            </div>
                                            

                                        </div><!-- /.box-body -->
                                       
                                    </form>
                                   
                            </div>

                        </div>
                        
                    </div>
                        <div class="row" id="rowprive">
                            <!-- left column -->
                            <div class="col-md-12" id="prive1">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Update Stock</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <div id="msg"></div>
                                    <form class="form-horizontal" >
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputbarcode" class="col-sm-2 control-label"> Barcode </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputbarcode" name="inputbarcode" placeholder="Barcode " readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputItem" class="col-sm-2 control-label">Particular/Item Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputItem" name="inputItem" placeholder="Particular/Item Name " readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputBrand" name="inputBrand" placeholder="Brand" readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSize" class="col-sm-2 control-label">Size</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputSize" name="inputSize" placeholder="Size" readonly="" required="">
                                                </div>
                                                <label for="inputUnit" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputUnit" name="inputUnit" placeholder="Unit" readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputQuantity" class="col-sm-2 control-label">Quantity</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputQuantity" name="inputQuantity" placeholder="Quantity" required="">
                                                </div>
                                                <label for="inputPopup" class="col-sm-2 control-label">POP UP</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputPopup" name="inputPopup" placeholder="POP UP" required>
                                                    <span><strong>Note:-</strong> POP UP Message display on stock before finish</span>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="inputPrice" class="col-sm-2 control-label">Price/Rate</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputPrice" name="inputPrice" placeholder="Price" required>
                                                </div>
                                                
                                            </div>

                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                            <button type="button" class="btn btn-info pull-right" onclick="return updataProduct()">Submit or Save</button>
                                        </div><!-- /.box-footer -->
                                    </form>
                                </div><!-- /.box -->
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <div>
                                        <label style="background-color: red; border: #f1f1f1 solid 2px; border-radius: 100%; color: #FFF;"><strong style="font-size: 30px">OR</strong></label>
                                    </div>
                                </center>
                            </div>
                        </div> 
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Update Stock Item form Excel File</h3>
                                        <a href="Retail_Stock_Template.xls" style="float:right;" class="btn btn-success">Download Template</a>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <center><p><strong>Note:-</strong>Download Excel file and fill your item's detail with excel file format and upload. </p></center>
                                    <form role="form" id="uploadForm"  action="System/S_UpdateStockFromExcel.php" method="post" enctype="multipart/form-data">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                <label for="exampleInputFile">File input</label>
                                                <input name="FileInput" id="FileInput" type="file" accept=".xls" />
                                                <p class="help-block">Example block-level help text here.</p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <img src="One Moment Please Star Loader.gif" alt="" width="200px" height="200px"  id="loading"/>
                                                </div>
                                            </div>
                                            

                                        </div><!-- /.box-body -->
                                        
                                        <div class="box-footer">
                                            <input type="submit"  id="submit-btn" class="btn btn-primary btn-xs" value="Upload" />
                                        </div>
                                    </form>
                                     <div id="targetLayer">
                                        
                                    </div>
                                </div><!-- /.box -->
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
             ?>
                <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
                
                
                <script>
                $(document).ready(function (){
                     $("#uploadForm").on('submit', (function (e) {
                            $("#loading").show();
                            e.preventDefault();
                            $.ajax({
                                url: "System/S_UpdateStockFromExcel.php",
                                type: "POST",
                                data: new FormData(this),
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function (data) {
                                    $("#loading").hide();
                                    $("#targetLayer").html(data);
                                    $("#targetLayer").show();
                                },
                                error: function () {}
                            });
                        }));
                });
                function closew()
{
    $("#targetLayer").toggle(1000);
}
                </script>
                <?php
            require_once 'Layout/DashboardScriptLink.php';
            ?>
              
    </body>
</html>
