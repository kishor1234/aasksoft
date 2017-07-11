<?php

session_start();
require_once '../DataBase/DBConnection.php';
$email = $_SESSION['loginEmail'];

function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

try {
    $query = "select * from rstock where shopemail='" . $email . "' and barcode='" . removeNoice('inputBarcodeScane') . "'";
    $result = $mysqli_object->query($query);
    if ($result->num_rows != 0) {
        if ($row = $result->fetch_assoc()) {
            echo'    <div class="col-md-12" id="prive2">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Update Stock</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <div id="msg"></div>
                                    <form class="form-horizontal">
                                        <div class="box-body">
                                         <div class="form-group">
                                                <label for="inputbarcode" class="col-sm-2 control-label"> Barcode </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="' . $row['barcode'] . '" id="inputbarcode" name="inputbarcode" placeholder="Particular/Item Name " readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputItem" class="col-sm-2 control-label">Particular/Item Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="' . $row['item'] . '" id="inputItem" name="inputItem" placeholder="Particular/Item Name " readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="' . $row['brand'] . '" id="inputBrand" name="inputBrand" placeholder="Brand" readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSize" class="col-sm-2 control-label">Size</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputSize" value="' . $row['size'] . '" name="inputSize" placeholder="Size" readonly="" required="">
                                                </div>
                                                <label for="inputUnit" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputUnit" value="' . $row['unit'] . '" name="inputUnit" placeholder="Unit" readonly="" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputQuantity" class="col-sm-2 control-label">Quantity</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputQuantity" name="inputQuantity" placeholder="Quantity" required="">
                                                </div>
                                                <label for="inputPopup" class="col-sm-2 control-label">POP UP</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" value="' . $row['popup'] . '" id="inputPopup" name="inputPopup" placeholder="POP UP" required>
                                                    <span><strong>Note:-</strong> POP UP Message display on stock before finish</span>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="inputPrice" class="col-sm-2 control-label">Price/Rate</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputPrice" value="' . $row['price'] . '" name="inputPrice" placeholder="Price" required>
                                                </div>
                                                
                                            </div>

                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                            <button type="submit" class="btn btn-info pull-right" onclick="return updataProduct()">Submit or Save</button>
                                        </div><!-- /.box-footer -->
                                    </form>
                                </div><!-- /.box -->
                            </div>';
        } else {
            echo '     <div class="col-md-12" id="prive1">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Update Stock</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <div id="msg"></div>
                                    <form class="form-horizontal">
                                        <div class="box-body">
                                         <div class="form-group">
                                                <label for="inputbarcode" class="col-sm-2 control-label"> Barcode </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputbarcode" name="inputbarcode" placeholder="Particular/Item Name " readonly="" required="">
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
                                            <button type="submit" class="btn btn-info pull-right" onclick="return updataProduct()">Submit or Save</button>
                                        </div><!-- /.box-footer -->
                                    </form>
                                </div><!-- /.box -->
                            </div>';
        }
    } else {
         
                ?>
                <script>alert("Selected Item is not in stock please update stock");</script>
                <?php
    }
} catch (Exception $ex) {
    
}
   
    
