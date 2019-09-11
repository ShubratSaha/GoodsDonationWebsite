<?php
    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Donators.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $user = new Donators($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $user->id = $data->id;
    $user->age = $data->age;
    $user->address = $data->address;
    $user->city = $data->city;
    $user->state = $data->state;
    $user->pincode = $data->pincode;
    $user->phone = $data->phone;
    $user->email = $data->email;
    $user->pwd = $data->pwd;

    $result = $user->check();
    $num = $result->rowCount();

    $ctr = 0;

    //Check if any posts
    if ($num > 0){
        $posts_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $post_item = array(
                'id' => $id,
                'email' => $email,
                'pwd' => $pwd
            );
            if (password_verify($user->pwd, $pwd) && $user->email == $email){
                $ctr = $ctr + 1;
            }
            
        }
        if ($ctr > 0){
            // Update Post
            if ($user->update()){
                echo json_encode(
                    array('message' => 'Updated')
                );
            }
            else{
                echo json_encode(
                    array('message' => 'Wrong Password')
                );
            }
        }
        else
            echo json_encode(
                array('message' => 'Wrong Password')
            );
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'Wrong Password')
        );
    }

    
?>