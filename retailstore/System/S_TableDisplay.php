<?php
//display
            echo '<table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Items</th>
                      <th>Qty</th>
                      <th style="width: 40px">Rate</th>
                      <th style="width: 40px">Total Price</th>
                      <th style="width: 40px">User Action</th>
                    </tr>';
            $rc = $mysqli_object->query("select * from rkart where shopemail='$email'");
            $i = 1;
            while ($row = $rc->fetch_assoc()) {
                echo'<tr>
                      <td>' . $i . '</td>
                      <td>' . $row['item'] . '</td>
                      <td>
                        ' . $row['qty'] . '
                      </td>
                      <td><span class="badge bg-blue">' . $row['rate'] . '</span></td>
                      <td><span class="badge bg-blue">' . $row['totalprice'] . '</span></td>
                          <td><a href="javascript:void(0)" onclick="deleteItemFromCart(' . $row['barcode'] . ',' . $row['qty'] . ')" style="color:red;" class="btn btn-default btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                   

</tr>';
                $netAmount = $netAmount + (float) $row['totalprice'];
            }
            echo'</table>';
            ?><h1 style="float:right; color: #0063dc; padding-right: 75px;" id="cartTotalAmount"><label style="color:#000;">Total Amount: </label><strong>&nbsp;&nbsp;&nbsp;<?php echo $netAmount;?></strong></h1>
            <br><br><br><?php                            
            echo ' </div><!-- /.box-body -->
                
                <div class="box-footer" id="printBill">
                  <div class="box-header with-border">
                                        <h3 class="box-title">Billing Detail for User</h3>
                                        <a href="javascript:void(0)" onclick="closeBillingUserDetail()" style="float: right;" title="Close OR Hide"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        
                                    </div><!--action="System/S_BarcodeScanforUpdatStock.php" method="post"-->
                                    <form class="form-horizontal" id="scanner" name="scanner" action="#" method="post">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inputCustomerName"  class="col-sm-2 control-label">Customer Name</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputCustomerName" name="inputCustomerName" placeholder="Customer Name " required="">
                                                </div>
                                                <label for="inputCustomerEmail"  class="col-sm-2 control-label">Customer Email</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputCustomerEmail" name="inputCustomerEmail" placeholder="Customer Email "  required="">
                                                </div>
                                           </div>
                                            
                                            <div class="form-group">
                                                <label for="inputCustomerMobile"  class="col-sm-2 control-label">Mobile</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputCustomerMobile" name="inputCustomerMobile" placeholder="Mobile "  required="">
                                                </div>
                                                <label for="inputNetAmount"  class="col-sm-2 control-label">NetAmount</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputNetAmount" name="inputNetAmount" value="' . $netAmount . '" placeholder="NetAmount" required="" readonly>
                                                </div>
                                           </div>
                                            
                                            <div class="form-group">
                                                <label for="inputCustomerMobile"  class="col-sm-2 control-label"></label>
                                                <div class="col-sm-4">
                                                  
                                                </div>
                                                <label for="inputVat"  class="col-sm-2 control-label">Vat(%)</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputVat" value="'.$vat.'" name="inputVat" placeholder="Vat"  required="" readonly>
                                                </div>
                                           </div>
                                            
                                            <div class="form-group">
                                                <label for="inputCustomerMobile"  class="col-sm-2 control-label"></label>
                                                <div class="col-sm-4">
                                                  
                                                </div>
                                                <label for="inputTotalAmount"  class="col-sm-2 control-label">Total Amount</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputTotalAmount" name="inputTotalAmount" placeholder="Total"  required="" readonly>
                                                </div>
                                           </div>
                                            <div class="box-footer with-border">
                                            </div>                                           

                                            <div class="form-group">
                                                <label for="inputCustomerMobile"  class="col-sm-8 control-label"></label>
                                                
                                                <div class="col-sm-4">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right" id="billPrnt" onclick="return billPrint()">Print</button>
                                                </div>
                                           </div>
                                           
                                        </div><!-- /.box-body -->
                                       
                                    </form>
                </div>
                                   ';
            //End Display
            ?>