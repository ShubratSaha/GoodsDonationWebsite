<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Contact_Us.php';

    $database = new Database();
    $db = $database->connect();

    $contact = new Contact_Us($db);

    $data = json_decode(file_get_contents("php://input"));
    $contact->name = $data->name;
    $contact->email = $data->email;
    $contact->message = $data->message;

    if ($contact->create()){
        echo json_encode(
            array('message' => 'You will be responded as soon as possible.')
        );
    }
    else{
        echo json_encode(
            array('message' => 'Sorry, we are not able to process your request.')
        );
    }
?>