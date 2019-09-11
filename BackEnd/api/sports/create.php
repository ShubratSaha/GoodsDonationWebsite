<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Sports.php';

    $database = new Database();
    $db = $database->connect();

    $sport = new Sports($db);

    $data = json_decode(file_get_contents("php://input"));
    $sport->name = $data->name;
    $sport->quantity = $data->quantity;
    $sport->did = $data->did;

    if ($sport->create()){
        echo json_encode(
            array('message' => 'Created')
        );
    }
    else{
        echo json_encode(
            array('message' => 'Not Able to Create')
        );
    }
?>