<?php
$page = "login";
include "header.php";

$is_loggedin = false;
$alert = "";
$task="";
//die("testing");
//die($input_user. $admin_user);
if(isset($_POST['task']))
{
   $task=htmlspecialchars($_POST['task']); 
}

// logout
if($task == "logout") {
  setcookie("aasksoftmap_user", "", time()+3600000);
  setcookie("aasksoftmap_pass", "", time()+3600000);
  header("Location: login.php");
  exit;
}

// attempt login
if($task == "dologin") {
  $input_user = htmlspecialchars($_POST['user']);
  $input_pass = htmlspecialchars($_POST['pass']);
  if(trim($input_user) == "" || trim($input_pass) == "") {
    $alert = "Nope. Wanna try that again?";
  } else {
    if(crypt($input_user, $admin_user) == crypt($admin_user, $admin_user) && crypt($input_pass, $admin_pass) == crypt($admin_pass,$admin_pass)) {
      setcookie("aasksoftmap_user", crypt($input_user, $admin_user), time()+3600000);
      setcookie("aasksoftmap_pass", crypt($input_pass, $admin_pass), time()+3600000);
      header("Location: index.php");
      exit;
    } else {
      $alert = "The information you provided was invalid. :(";
    }
  }
}

?>






<?php echo $admin_head; ?>

<form class="well form-inline" action="login.php" id="login" method="post">
  <h1>
   @askSoft Map Admin
  </h1>
  <?php
    if($alert != "") {
      echo "
        <div class='alert alert-danger'>
          $alert
        </div>
      ";
    }
  ?>
  <input type="text" name="user" class="input-large" placeholder="Username">
  <input type="password" name="pass" class="input-large" placeholder="Password">
  <button type="submit" class="btn btn-info">Sign in</button>
  <input type="hidden" name="task" value="dologin" />
</form>

<?php echo $admin_foot; ?>