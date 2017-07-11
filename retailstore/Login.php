<!DOCTYPE html>

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
    </body>
</html>