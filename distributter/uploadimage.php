<?php
session_start();
require_once 'DataBase/DBConnection.php';
$email=$_SESSION['loginEmail'];
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 200000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("upload/" . $_FILES["file"]["name"])) {
echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
//die($_FILES["file"]["type"]);
$targetPath;
switch($_FILES["file"]["type"])
{
    case "image/png":
        $targetPath = "upload/".$email.".png";
        break;
    case "image/jpg":
        $targetPath = "upload/".$email.".jpg";
        break;
    case "image/jpeg":
        $targetPath = "upload/".$email.".jpeg";
        break;
    default :
        break;
}
//$targetPath = "upload/".$email.$_FILES["file"]["type"]; // Target path where file is to be stored
//$imgData;
//if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    
 
                    // prepare the image for insertion
                    //$imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
                    $mysqli_object->query("UPDATE shopes SET shoplogo='$targetPath' WHERE email='$email'");
//}
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
//echo $imgData;
echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}
}
?>