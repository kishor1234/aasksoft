<!DOCTYPE html>

<?php
session_start();
require_once 'System/EncandDec.php';
require_once 'DataBase/DBConnection.php';
if(isset($_SESSION['loginEmail']))
{
 ?>
            	<script type="text/javascript">
window.location.href = 'Home.php';
</script>
            	<?php
}
function removeNoice($data) {
    return filter_input(INPUT_POST, $data);
}

$msg = "";
if (isset($_POST['login'])) {
    
    $result = $mysqli_object->query("SELECT * FROM shopes where email='" . removeNoice('inputEmail') . "' and password='" . md5(removeNoice('inputPassword')) . "' and emailvarification=1");
    //die("SELECT * FROM shopes where email='" . removeNoice('inputEmail') . "' and password='" . md5(removeNoice('inputPassword')) . "' and emailvarification=1");
    if ($result->num_rows == 1) {
        $_SESSION['loginEmail'] = removeNoice('inputEmail');
        $row = $result->fetch_assoc();
        $_SESSION['loginUser'] = $row['shopname'];
        $_SESSION['shoptype'] = $row['shoptype'];
        $reusult = $mysqli_object->query("select * from shoptype where shoptype='".$row['shoptype']."'");
        if($row2 = $reusult->fetch_assoc()) {
            if(strcmp($row['shoptype'],$row2['shoptype'])==0)
            {
            //die($uri.$row2['redirect']);
                //header("Location: ".$uri.$row2['redirect']);
                ?>
            	<script type="text/javascript">
window.location.href = '<?php echo $uri.$row2['redirect'];?>';
</script>
            	<?php
                //header("Location: ".$row2['redirect']);
            }
            else
            {
                $msg='<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Oh snap!</strong> Please contact admin
                        </div>';
            }
        }
        else
        {
            $msg='<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Oh snap!</strong> Please contact admin Server Down
                    </div>';
        }
      
        
        }      
        else {
        $result=$mysqli_object->query("SELECT * FROM shopes where email='".removeNoice('inputEmail')."' and emailvarification='0'");
        if($result->num_rows==1)
        {
        $msg='<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Oh snap!</strong> Email Id Not Varified Please Vaified
                </div>';
        }
        else
        {
        $msg='<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Oh snap!</strong> Invalid Username and Password
                </div>'; 
        }

        }

        }
        ?>
        <html>
            <head>
                <title>

                </title>

                <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
            </head>
            <style>
                body
                {
                    background-color: #f1f1f1;
                }
                #loginform
                {

                    max-width: 20em;
                }
                #login
                {
                    border: 1px #d8ddd5 solid;
                    box-shadow: 0px 0px 2px 2px #f1f1f1;
                    border-radius: 2%;
                    margin-top: 10em;
                }
                label
                {
                    font-family: monospace;

                }
                #headding 
                {
                    display: none;
                }
                body{
                    background: #fff url(login-bg.svg?7);
                    background-size: 320.2px 407px;
                    height: 100%;
                }
            </style>
            <body >

                <div class="container">




                    <center>

                        <div id="loginform">
                            <div id="msg">
                                <?php echo $msg; ?>
                    </div>
                    <div class='panel-heading' id="headding">
                        <h1 class="panel-title">Login</h1>
                    </div>
                    <div class="panel panel-danger" id="login">
                        <header class='panel-heading'>
                            <h1 class="panel-title">Retail Store Login  Portal</h1>
                        </header>
                        <br>
                        <form method="post">
                            <table>
                                <tr>
                                    <td>
                                        <label>User Name</label>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <input type="text" required="" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr><tr>
                                    <td>
                                        <label>Password</label>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <input type="password" required class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <input type="submit" id='Login' class="btn btn-success"  name="login" value="Login">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                    </div>
                </div>
            </center>
        </div>
        <div style="position:fixed; bootom:0; width:100%;">
            <center>
                <span><a href="Register.php">Create New Account</a></span><br><br><br><br><br><br><br><br>
                <span>powered by <a href="http://www.aasksoft.com"  target="mainfram2">aasksoft.com</a></span>
            </center>
        </div>
        <script src="bootstrap/js/jquery.1.11.1.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $("#msg").toggle(900);
                }, 5000);
            });
        </script>
    </body>
</html>