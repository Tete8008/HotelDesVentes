<?php
    $db_server="localhost";
    $db_username="root";
    $db_password="";
    $db_name="rubika";
    $db;

    function connectToDB(){
        global $db_server,$db_username,$db_password,$db_name,$db;
        try{
            $db=new PDO("mysql:host=".$db_server.";dbname=".$db_name.";charset=utf8",$db_username,$db_password);
        }catch(PDOException $pe){
            echo "connection failed : ".$pe->getMessage();
            return false;
        }
        return true;
    }

    

?>