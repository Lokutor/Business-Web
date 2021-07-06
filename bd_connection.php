<?php
    $host = 'localhost';
    $user = 'wn11hhsa_adp';
    $password = 'wn11hhsa_adp';
    $database = 'wn11hhsa_adp';
    $conn = new mysqli('localhost', 'wn11hhsa_adp', 'wn11hhsa_adp', 'wn11hhsa_adp');

    if($conn->connect_error){
        echo $error->$conn->$connect_error;
    }
?>