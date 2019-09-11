<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Go_Green.php';

    $database = new Database();
    $db = $database->connect();

    $contact = new Go_Green($db);

    $data = json_decode(file_get_contents("php://input"));
    $contact->name = $data->name;
    $contact->email = $data->email;
    $contact->tree_type = $data->tree_type;

    if ($contact->create()){
        echo json_encode(
            array('message' => 'Your Tree will be planted.')
        );
    }
    else{
        echo json_encode(
            array('message' => 'Sorry, Due to some issues the system is not working.')
        );
    }
?>