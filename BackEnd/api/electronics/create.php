<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Electronics.php';

    $database = new Database();
    $db = $database->connect();

    $electronic = new Electronics($db);

    $data = json_decode(file_get_contents("php://input"));
    $electronic->name = $data->name;
    $electronic->quantity = $data->quantity;
    $electronic->did = $data->did;

    if ($electronic->create()){
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