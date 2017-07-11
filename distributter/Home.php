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
            <?php
                require_once 'Layout/ContainNav.php';
            ?>
        </div>
            <?php
    require_once 'Layout/Footer.php';
    require_once 'Layout/DashboardScriptLink.php';
    ?>
    </body>
</html>
