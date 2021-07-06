<?php
    require_once "bd_connection.php";

    $store = $_POST['store'];
    $configurator = $_POST['configurator'];
    $pos = $_POST['pos'];
    

    function getNameFromDb($table_name, $store_name){
        $sql = "SELECT ${table_name}.name ";
        $sql .= "FROM ${table_name} ";
        $sql .= "WHERE ${table_name}.name='${store_name}'";
        return $sql;
    }

    function insertNameToDb($table_name, $value){
        $sql = "INSERT INTO ${table_name} (name) ";
        $sql .= "VALUES ('${value}')";
        return $sql;
    }
    
    $response = array();
    $invalid=false;
    $isInserted=false;
    $oneFieldDone=false;
    //Verify if exists name input from store
    if(!(empty($store))){
        $sql=getNameFromDb("store", $store);
        $result = $conn->query($sql);
        if(!($result->num_rows > 0)){
            $sql=insertNameToDb("store", $store);
            $result = $conn->query($sql);
            $isInserted=true;
        }
        $oneFieldDone=true;
    }else{
        $invalid=true;
    }
    
    //Verify if exists name input from configurator
    if(!(empty($configurator))){
        $sql=getNameFromDb("configurator", $configurator);
        $result = $conn->query($sql);

        if(!($result->num_rows > 0)){
            $sql=insertNameToDb("configurator", $configurator);
            $result = $conn->query($sql);
            $isInserted=true;
        }
        $oneFieldDone=true;
        $invalid=false;
    }else{
        if(!$oneFieldDone)
            $invalid=true;
    }
    
    //Verify if exists name input from pos
    if(!(empty($pos))){
        $sql=getNameFromDb("pos", $pos);
        $result = $conn->query($sql);

        if(!($result->num_rows > 0)){
            $sql=insertNameToDb("pos", $pos);
            $result = $conn->query($sql);
            $isInserted=true;
        }
        $oneFieldDone=true;
        $invalid=false;
    }else{
        if(!$oneFieldDone)
            $invalid=true;
    }
    
    /*
    $sql = "INSERT INTO store (name)";
    $sql .= "VALUES ('${store}')";
    */

    if(!$invalid){
        if($isInserted){
            $response["status"]="success";
            $response["type"]="companyAdd";
            $response["message"]="You inserted a new record!";
        }else{
            $response["status"]="warning";
            $response["type"]="companyExists";
            $response["message"]="This company or record already exists!";
        }
    }else{
        $response["status"]="danger";
        $response["message"]="Please insert a valid data!";
        
    }
    //$response["success"]=false;
    //$response["message"]=$conn->error;


    header('Content-type: application/json');
    echo json_encode($response);

    $conn->close();
?>