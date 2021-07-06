<?php

$store = $_POST['store'];
$configurator = $_POST['configurator'];
$pos = $_POST['pos'];
$url_input = $_POST['url'];

$date_time = date("Y-m-d H:i:s");

try {
    
    require_once "bd_connection.php";
    
    $sql = "SELECT url_business.id, url, id_store, id_configurator, id_pos ";
    $sql .= "FROM url_business ";
    $sql .= "INNER JOIN store ";
    $sql .= "ON url_business.id_store = store.id ";
    $sql .= "INNER JOIN configurator ";
    $sql .= "ON url_business.id_configurator = configurator.id ";   
    $sql .= "INNER JOIN pos ";
    $sql .= "ON url_business.id_pos = pos.id ";
    $sql .= "WHERE store.id='${store}' AND ";
    $sql .= "configurator.id='${configurator}' AND ";
    $sql .= "pos.id='${pos}';";
    
    $result = $conn->query($sql);
} catch (\Exception $e) {
    echo $e->getMessage(); 
}

$response = array();

if($result->num_rows > 0){
    while($business = $result->fetch_assoc()){
        $url = $business['url'];
        $id_url_business = $business['id'];
        $id_store = $business['id_store'];
        $id_configurator = $business['id_configurator'];
        $id_pos = $business['id_pos'];
    }
    
    try {
        $sql = "INSERT INTO history (date_time, id_url_business) ";
        $sql .= "VALUES ('${date_time}', ${id_url_business});";
        $conn->query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage(); 
    }
    //header('location: '.$url);
    if ($url != $url_input){
        $sql = "UPDATE url_business ";
        $sql .= "SET url='${url_input}' ";
        $sql .= "WHERE id=${id_url_business};";
        $conn->query($sql);
    }
    
    $response["status"]="success";
    $response["message"]="Welcome to the company!";
    $response["type"]="companyLogin";
    header('Content-type: application/json');
    echo json_encode($response);
    
}else{
    if(!empty($url_input) && !empty($store) && !empty($configurator) && !empty($pos)){
        $sql = "INSERT INTO url_business (id_store, id_configurator, id_pos, url) ";
        $sql .= "VALUES (${store}, ${configurator}, ${pos}, '${url_input}')";
        $conn->query($sql);

        $response["status"]="success";
        $response["message"]="You created a new link for this company!";
        $response["type"]="companyUser";
    }else{
        $response["status"]="danger";
        $response["message"]="Please, insert every field!";
    }
    
    header('Content-type: application/json');
    echo json_encode($response);
}

$conn->close();
?>