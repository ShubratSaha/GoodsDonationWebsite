<?php
    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Books.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $book = new Books($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $book->id = $data->id;

    // Update Post
    if ($book->delete()){
        echo json_encode(
            array('message' => 'Deleted')
        );
    }
    else{
        echo json_encode(
            array('message' => 'Not Deleted')
        );
    }
?>