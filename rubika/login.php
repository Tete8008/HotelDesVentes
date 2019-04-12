<?php
    include("bdd.php");
    $errors=array();
    $answer=array(
        "connected"=>false,
        "errors"=>$errors
    );

    //login is received
    if (isset($_POST["login"])){
        $login=$_POST["login"];
        //connection to database is successful
        if (connectToDB()){
            $sql="SELECT * FROM rubika_users WHERE login = :login";
            $stmt=$db->prepare($sql);
            $stmt->execute(array(":login"=>$login));
            $data=$stmt->fetch();



            //if data is empty
            if (!$data){
                array_push($errors,"Account not found");
            }else{
                $playerData=array(
                    "id"=>$data["id"],
                    "name"=>$data["name"],
                    "firstname"=>$data["firstname"],
                    "login"=>$data["login"],
                    "level"=>$data["level"],
                    "inventory"=>$data["inventory"]
                );
    
                $answer["connected"]=true;
                $answer["playerData"]=$playerData;
            }

            

        //connection to db has failed
        }else{
            array_push($errors,"unable to connect to database");
        }
    }
    //login has not been received
    else{
        array_push($errors,"missing connection information");
    }

    $answer["errors"]=$errors;


    header("Content-Type:application/json;charset=utf-8;");
    echo json_encode($answer);

?>