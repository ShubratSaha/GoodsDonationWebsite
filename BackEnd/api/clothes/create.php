<?php
    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Clothes.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog donator object
    $cloth = new Clothes($db);

    //Get raw donatored data
    $data = json_decode(file_get_contents("php://input"));
    $cloth->name = $data->name;
    $cloth->quantity = $data->quantity;
    $cloth->did = $data->did;

    // Create donator
    if ($cloth->create()){
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