<?php 
session_start();
 require_once 'DataBase/DBConnection.php';
if(!isset($_SESSION['loginEmail']))
{
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
                        Purchase 
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li >Purchase </li>
                        <li class="active">Purchase Entry</li>
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
                                        <h3 class="box-title">Purchase Entry</h3>

                                    </div>
                                    <div class="box-body">
                                     
                                    </div><!-- /.box-body -->
                                    
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
                                        <form id="purchaseEntry" action="#" method="post">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label"><strong>Purchase</strong></label> 
                                            </div>
                                        </form>

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
