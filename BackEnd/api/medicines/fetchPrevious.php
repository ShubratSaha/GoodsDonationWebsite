<?php
    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Medicines.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $medicine = new Medicines($db);
    $user = new Medicines($db);

    //Blog Post Query
    $result = $medicine->read();
    //Get row count
    $num = $result->rowCount();

    $data = json_decode(file_get_contents("php://input"));
    $user->did = $data->did;

    $ctr = 0;

    //Check if any posts
    if ($num > 0){
        //Post array
        $posts_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $forDate = new DateTime($date);
            $post_item = array(
                'id' => $id,
                'name' => $name,
                'quantity' => $quantity,
                'status' => $status,
                'date' => date_format($forDate, 'd/m/Y'),
                'did' => $did,
                'message' => "Authorised"
            );
            if (password_verify($did, $user->did) && $status == "Previous"){
                array_push($posts_arr, $post_item);
                $ctr = $ctr + 1;
            }
        }
        if ($ctr > 0){
            echo json_encode($posts_arr);
        }
        else
            echo json_encode(
                array('message' => 'No Previous Donations')
            );
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'No Previous Donations')
        );
    }
?>