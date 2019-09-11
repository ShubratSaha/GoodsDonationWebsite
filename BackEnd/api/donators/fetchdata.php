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

    //Instantiate blog post object
    $donator = new Donators($db);
    $user = new Donators($db);

    //Blog Post Query
    $result = $donator->fetch();
    //Get row count
    $num = $result->rowCount();

    $data = json_decode(file_get_contents("php://input"));
    $user->id = $data->id;

    $ctr = 0;

    //Check if any posts
    if ($num > 0){
        //Post array
        $log = array();
        $posts_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $post_item = array(
                'id' => $id,
                'name' => $name,
                'age'=> $age,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'pincode' => $pincode,
                'phone' => $phone,
                'email' => $email,
                'message' => "Authorised",
            );
            if (password_verify($id, $user->id)){
                //Push to 'data'
                $log = $post_item;
                $ctr = $ctr + 1;
            }
        }
        if ($ctr > 0){
            echo json_encode($log);
        }
        else
            echo json_encode(
                array('message' => 'Not Authorised')
            );
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'Not Authorised')
        );
    }
?>