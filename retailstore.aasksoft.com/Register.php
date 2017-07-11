<?php
require_once 'DataBase/DBConnection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>New Store Registration</title>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="bootstrap/js/angular.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://iamrohit.in/lab/js/location.js"></script>
        <style>
            #allborder
            {
                border: #f1f1f1 solid 1px;
                border-radius: 2%;


            }
            #body{
                background: #fff url(login-bg.svg?7);
                background-size: 320.2px 407px;
                height: 100%;
            }
            span
            {
                color:red;
            }
        </style>
    </head>
    <body  ng-app="myApp">
        <nav class="navbar navbar-inverse" id="body">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Retail Store Registration</a>
                </div>


            </div>
        </nav>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8" id="allborder"><!--Register Form-->
                        <form class="form-horizontal" action="System/S_RegisterShop.php" method="POST" name="myForm">
                            <fieldset>
                                <legend>New Store Registration</legend>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-3 control-label">Email<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="inputEmail" name="inputEmail" ng-model="formData.inputEmail" placeholder="Email" required="">

                                        <span ng-show="myForm.inputEmail.$error.required && myForm.inputEmail.$dirty">required</span>
                                        <span ng-show="!myForm.inputEmail.$error.required && myForm.inputEmail.$error.email && myForm.inputEmail.$dirty">invalid email</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-3 control-label">Password<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password"  ng-model="formData.inputPassword" ng-minlength="8" ng-maxlength="20" ng-pattern="/(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z])/" required >
                                        <span ng-show="myForm.inputPassword.$error.required && myForm.inputPassword.$dirty">required</span>
                                        <span ng-show="!myForm.inputPassword.$error.required && (myForm.inputPassword.$error.minlength || myForm.inputPassword.$error.maxlength) && myForm.inputPassword.$dirty">Passwords must be between 8 and 20 characters.</span>
                                        <span ng-show="!myForm.inputPassword.$error.required && !myForm.inputPassword.$error.minlength && !myForm.inputPassword.$error.maxlength && myForm.inputPassword.$error.pattern && myForm.inputPassword.$dirty">Must contain one lower &amp; uppercase letter, and one non-alpha character (a number or a symbol.)</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword2" class="col-lg-3 control-label">Confirm  Password<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Confirm  Password" ng-model="formData.inputPassword2" valid-password-c required>
                                        <span ng-show="myForm.inputPassword2.$error.required && myForm.inputPassword2.$dirty">Please confirm your password.</span>
                                        <span ng-show="!myForm.inputPassword2.$error.required && myForm.inputPassword2.$error.noMatch && myForm.inputPassword2.$dirty">Passwords do not match.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMobileNumber" class="col-lg-3 control-label">Mobile No.<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="inputMobileNumber" name="inputMobileNumber" placeholder="Mobile Number" size="10" pattern="^\d{10}$" required="">
                                        <span><strong>Note:</strong> ex.(9890000000)</span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="shopType" class="col-lg-3 control-label">Shop Type<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="shopType" class="form-control" id="shopType"  required="">
                                                        <option value="">Select Shop Type</option>
                                                        <?php
                                                        $reusult=$mysqli_object->query("select * from shoptype");
                                                        while($row=$reusult->fetch_assoc())
                                                        {
                                                            echo'<option value="'.$row['shoptype'].'">'.$row['shoptype'].'</option>';
                                                        }
                                                        ?>
                                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputShopName" class="col-lg-3 control-label">Shop Name<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="inputShopName" id="inputShopName" placeholder="Shop Name">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-3 control-label">Address<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" name="address" maxlength="20" class="form-control" id="address" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-3 control-label">Country<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="country" class="countries form-control" id="countryId" name="country" required="">
                                                        <option value="">Select Country</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-3 control-label">State<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="state" class="states form-control" id="stateId"  required="">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-3 control-label">District<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <select name="district" class="cities form-control" id="cityId"  required="">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-3 control-label">City<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                         <input type="text" name="city"  class="form-control" id="city"  required="">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-3 control-label">PIN Code<span style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" name="pin" maxlength="6" class="form-control" id="pin" pattern="^\d{6}$" required="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="submit">Register</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="col-md-4"><!--Sponseard-->

                    </div>
                </div>
            </div>
        </section>
        <script>
            var app = angular.module("myApp", ['UserValidation']);
            angular.module('UserValidation', []).directive('validPasswordC', function () {
                return {
                    require: 'ngModel',
                    link: function (scope, elm, attrs, ctrl) {
                        ctrl.$parsers.unshift(function (viewValue, $scope) {
                            var noMatch = viewValue != scope.myForm.inputPassword.$viewValue
                            ctrl.$setValidity('noMatch', !noMatch)
                        })
                    }
                }
            });
        </script>
        <script src="bootstrap/js/jquery.1.11.1.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <script src="bootstrap/js/jquery.form.js" type="text/javascript"></script>
    </body>
</html>