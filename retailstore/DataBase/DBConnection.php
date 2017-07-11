<?php
<<<<<<< c132005a3387b83cd00c351b6c330f50b3c7c1ba
define('DB_USERNAME',       'aasksoft_user');
define('DB_PASSWORD',       'root@123');
define('DB_HOST',           'localhost');
define('DB_NAME',           'aasksoft_ruser');
=======
define('DB_USERNAME',       'root');
define('DB_PASSWORD',       'root');
define('DB_HOST',           'localhost');
define('DB_NAME',           'retailstore');
>>>>>>> Update aasksoft with some chages like add slider and add domain controll

$mysqli_object=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

if ($mysqli_object->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
       $uri.="/";

//echo "end";

