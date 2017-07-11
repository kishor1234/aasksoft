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
                        New Stock Items
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li >Stock</li>
                        <li class="active">New Stock</li>
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
                                        <h3 class="box-title">Add New Stock Item</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <div id="msg"></div>
                                    <form class="form-horizontal" name="NewStockID" id="NewStockID" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputItem" class="col-sm-2 control-label">Particular/Item Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputItem" name="inputItem" placeholder="Particular/Item Name " required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputBrand" name="inputBrand" placeholder="Brand" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSize" class="col-sm-2 control-label">Size</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputSize" name="inputSize" placeholder="Size" required>
                                                </div>
                                                <label for="inputUnit" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputUnit" name="inputUnit" placeholder="Unit" required>
                                                </div>
                                            </div>

                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="#" class="btn btn-default">Cancel</button>
                                            <input type="button" name="save" id="save" class="btn btn-info pull-right" value="Submit or Save">
                                        </div><!-- /.box-footer -->
                                    </form>
                                </div><!-- /.box -->
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <div>
                                        <h1><label style="background-color: red; border: #f1f1f1 solid 2px; border-radius: 100%; color: #FFF;"><strong style="font-size: 30px">OR</strong></label></h1>
                                    </div>
                                </center>
                            </div>
                        </div> 
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Add New Stock Item form Excel File</h3>
                                        <a href="Retail_Stock_Template (1).xls" style="float:right;" class="btn btn-success">Download Template</a>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <center><p><strong>Note:-</strong>Download Excel file and fill your item's detail with excel file format and upload. </p></center>
                                    <form role="form" id="uploadForm"  action="System/S_NewStockExcelImport.php" method="post" enctype="multipart/form-data">
                                        <div class="box-body">

                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                <label for="exampleInputFile">File input</label>
                                                <input name="FileInput" id="FileInput" type="file" accept="application/vnd.ms-excel" />
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
                                        <h3 class="box-title">Add New Stock Item form Excel File</h3>

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
                <script src="bootstrap/js/jquery-1.10.2.min.js" type="text/javascript"></script>
                <script src="bootstrap/js/jquery.form_1.js" type="text/javascript"></script>

                <script>

                    $(document).ready(function () {
                        $("#uploadForm").on('submit', (function (e) {
                            $("#loading").show();
                            e.preventDefault();
                            $.ajax({
                                url: "System/S_NewStockExcelImport.php",
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


                        function check()
                        {
                            if ($("#inputItem").val() == "")
                            {
                                alert("Item Required");
                                return false;
                            } else if ($("#inputBrand").val() == "")
                            {
                                alert("Brand Required");
                                return false;
                            } else if ($("#inputSize").val() == "")
                            {
                                alert("Size Required");
                                return false;
                            } else if ($("#inputUnit").val() == "")
                            {
                                alert("Unit Required");
                                return false;
                            } else
                            {
                                return true;
                            }
                        }
                        $("#save").click(function ()
                        {
                            if (check() == true)
                            {
                                var inputItem = $("#inputItem").val();
                                var inputBrand = $("#inputBrand").val();
                                var inputSize = $("#inputSize").val();
                                var inputUnit = $("#inputUnit").val();
                                $.post("System/S_NewStock.php", {inputItem: inputItem, inputBrand: inputBrand, inputSize: inputSize, inputUnit: inputUnit}, function (data) {
                                    $("#msg").show();
                                    $("#inputItem").val("");
                                    $("#inputBrand").val("");
                                    $("#inputSize").val("");
                                    $("#inputUnit").val("");
                                    $("#msg").html(data);
                                    setTimeout(function () {
                                        $("#msg").hide();
                                    }, 5000);
                                });
                            }


                        });
                       
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
