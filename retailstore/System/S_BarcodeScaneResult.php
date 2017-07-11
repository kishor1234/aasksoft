<?php
session_start();
require_once 'EncandDec.php';
require_once '../DataBase/DBConnection.php';
$encdec = new EncandDec();
$email=$_SESSION['loginEmail'];
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}
$result=$mysqli_object->query("select * from rstock where shopemail='$email' and barcode='".removeNoice('inputBarcodeScane')."' ");
//ho "select * from rstore where where email='$email' and barcode='".removeNoice('inputBarcodeScane')."' ";
if($row=$result->fetch_assoc())
{
    echo '<div class="col-md-12" id="ProductInfo2">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Update Stock</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputItem" class="col-sm-2 control-label">Particular/Item Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputItem" name="inputItem" value="'.$row['item'].'" placeholder="Particular/Item Name" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputBrand" name="inputBrand" value="'.$row['brand'].'" placeholder="Brand" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSize" class="col-sm-2 control-label">Size</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputSize" name="inputSize" value="'.$row['size'].'" placeholder="Size" required readonly>
                                                </div>
                                                <label for="inputUnit" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputUnit" name="inputUnit" value="'.$row['unit'].'" placeholder="Unit" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSize" class="col-sm-2 control-label">Quantity</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputSize" name="inputSize" placeholder="Quantity" required>
                                                </div>
                                                <label for="inputUnit" class="col-sm-2 control-label">POP UP</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputUnit" name="inputUnit" placeholder="POP UP" required>
                                                    <span><strong>Note:-</strong> POP UP Message display on stock before finish</span>
                                                </div>
                                            </div>

                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                            <button type="submit" class="btn btn-info pull-right">Submit or Save</button>
                                        </div><!-- /.box-footer -->
                                    </form>
                                </div><!-- /.box -->
                            </div>';
}
 else {
    
 
echo' <div class="col-md-12" id="ProductInfo">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Update Stock</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputItem" class="col-sm-2 control-label">Particular/Item Name </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputItem" name="inputItem" placeholder="Particular/Item Name" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBrand" class="col-sm-2 control-label">Brand</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputBrand" name="inputBrand" placeholder="Brand" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSize" class="col-sm-2 control-label">Size</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputSize" name="inputSize" placeholder="Size" required readonly>
                                                </div>
                                                <label for="inputUnit" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputUnit" name="inputUnit" placeholder="Unit" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSize" class="col-sm-2 control-label">Quantity</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputSize" name="inputSize" placeholder="Quantity" required>
                                                </div>
                                                <label for="inputUnit" class="col-sm-2 control-label">POP UP</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputUnit" name="inputUnit" placeholder="POP UP" required>
                                                    <span><strong>Note:-</strong> POP UP Message display on stock before finish</span>
                                                </div>
                                            </div>

                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                            <button type="submit" class="btn btn-info pull-right">Submit or Save</button>
                                        </div><!-- /.box-footer -->
                                    </form>
                                </div><!-- /.box -->
                            </div>';
 }