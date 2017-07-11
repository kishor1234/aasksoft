<?php
//include "DBConnection.php";
        define('DB_USERNAME',       'root');
        define('DB_PASSWORD',       '');
        define('DB_HOST',           'localhost');
        define('DB_NAME',           'suhas');
        $mysqli_object=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
Class DataBase
{
    
    public function __construct() {
        //echo "Start<br>";
        
        //$this->index();
    }
    /*function index()
    {
        echo "Wel Come<br>";
        $result=mysqli_query($GLOBALS['mysqli_object'],"SELECT * FROM `model_login` ");

        while($row=mysqli_fetch_array($result,MYSQLI_BOTH))
        {
            echo $row["username"]."<br>";

        }
    }*/
    function insertQuery($query)
    {
        try 
        {
            mysqli_query($GLOBALS['mysqli_object'], $query);
            return true;
        } catch (Exception $ex) {
            
        }
        return false;
    }
    function selectQuery($query)
    {
        try
        {
            return mysqli_query($GLOBALS['mysqli_object'],$query);
        } catch (Exception $ex) {

        }
        return null;
    }
}

//new DataBase();