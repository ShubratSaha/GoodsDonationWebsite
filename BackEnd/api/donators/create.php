<?php
    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Donators.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog donator object
    $donator = new Donators($db);

    //Get raw donatored data
    $data = json_decode(file_get_contents("php://input"));
    $donator->name = $data->name;
    $donator->age = $data->age;
    $donator->address = $data->address;
    $donator->city = $data->city;
    $donator->state = $data->state;
    $donator->pincode = $data->pincode;
    $donator->phone = $data->phone;
    $donator->email = $data->email;
    $donator->pwd = password_hash($data->pwd, PASSWORD_DEFAULT);

    // Create donator
    if ($donator->create()){
        echo json_encode(
            array('message' => 'Donator Added')
        );
    }
    else{
        echo json_encode(
            array('message' => 'Donator Not Added')
        );
    }
?>