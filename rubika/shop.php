<?php
    include("bdd.php");

    $errors=array();
    $answer=array(
        "items"=>array()
    );

    if (connectToDB()){
        $sql="SELECT * FROM rubika_shop";
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $data=$stmt->fetchAll();

        for ($i=0;$i<count($data);$i++){
            $answer["items"][$i]=array(
                "name"=>$data[$i]["id"],
                "item"=>$data[$i]["item"],
                "price"=>$data[$i]["price"]
            );
            if ($data[$i]["available"]==1){
                $answer["items"][$i]["available"]="true";
            }else{
                $answer["items"][$i]["available"]="false";
            }
        }


    }else{
        array_push($errors,"connection to database failed");
    }


    $answer["errors"]=$errors;


    header("Content-Type:application/json;charset=utf-8;");
    echo json_encode($answer);


?>
