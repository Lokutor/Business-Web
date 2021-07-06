<?php
    require_once "bd_connection.php";

    $firstDate = $_POST['firstDate'];
    $lastDate = $_POST['lastDate'];
    $store = $_POST['store'];
    $configurator = $_POST['configurator'];
    $pos = $_POST['pos'];
    
    $emptyFirst=false;
    $emptyLast=false;

    //Validate inputs
    if(empty($firstDate)){
        $firstDate = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
        $emptyFirst=true;
    }
    if(empty($lastDate)){
        $lastDate = date("Y-m-d H:i:s");
        $emptyLast=true;
    }
    if(!(empty($store))){
        $searchStore = " store.id=${store} AND ";
    }else{
        $searchStore = "";
    }
    if(!(empty($configurator))){
        $searchConfigurator = " configurator.id=${configurator} AND ";
    }else{
        $searchConfigurator = "";
    }
    if(!(empty($pos))){
        $searchPos = " pos.id=${pos} AND ";
    }else{
        $searchPos = "";
    }
    //SQL query to obtain store, configurator, pos and date
    $sql = "SELECT date_time, store.name AS name_store, configurator.name AS name_configurator, ";
    $sql .= "pos.name AS name_pos ";
    $sql .= "FROM `history` ";
    $sql .= "JOIN url_business ";
    $sql .= "ON id_url_business = url_business.id ";
    $sql .= "JOIN store ";
    $sql .= "ON url_business.id_store = store.id ";
    $sql .= "JOIN configurator ";
    $sql .= "ON url_business.id_configurator = configurator.id ";
    $sql .= "JOIN pos ";
    $sql .= "ON url_business.id_pos = pos.id ";
    $sql .= "WHERE ${searchStore} ${searchConfigurator} ${searchPos} ";
    $sql .= "date_time BETWEEN '${firstDate}' AND ";
    $sql .= "'${lastDate}' ";
    $sql .= "ORDER BY `history`.`id` DESC";
    
    $result = $conn->query($sql);

    $business = array();
    /*Result is set in array.
      If it didn't find a business, send an danger alert*/
    if($result->num_rows > 0){
        $i=0;
        while($history = $result->fetch_assoc()){
            $business[$i] = $history;
            $i++;
        }
        
        $response = array();

        if($emptyFirst && $emptyLast){
            $response["warning"]=true;
            $response["message"]="As you did not choose a date, automatically goes from a <b>month ago</b> to <b>today</b>";
        }else{
            $response["warning"]=false;
        }
        $response["status"]="success";
        
        $response["type"]="companyDate";
        $response["company"]=$business;
        header('Content-type: application/json');
        echo json_encode($response);
    }
    else{
        
        $response["message"]="History not found!";
        $response["status"]="danger";
        header('Content-type: application/json');
        echo json_encode($response);
    }
    
    $conn->close();
?>
