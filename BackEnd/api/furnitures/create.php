<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Furnitures.php';

    $database = new Database();
    $db = $database->connect();

    $furniture = new Furnitures($db);

    $data = json_decode(file_get_contents("php://input"));
    $furniture->name = $data->name;
    $furniture->quantity = $data->quantity;
    $furniture->did = $data->did;

    if ($furniture->create()){
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