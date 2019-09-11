<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Books.php';

    $database = new Database();
    $db = $database->connect();

    $book = new Books($db);

    $data = json_decode(file_get_contents("php://input"));
    $book->name = $data->name;
    $book->quantity = $data->quantity;
    $book->did = $data->did;

    if ($book->create()){
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