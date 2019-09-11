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
    $result = $donator->login();
    //Get row count
    $num = $result->rowCount();

    $data = json_decode(file_get_contents("php://input"));
    $user->email = $data->email;
    $user->pwd = $data->pwd;

    $ctr = 0;

    //Check if any posts
    if ($num > 0){
        //Post array
        $log = array();
        $posts_arr['data'] = array();
        session_start();
        $_SESSION['uid']=uniqid('ang_');

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $post_item = array(
                'id' => password_hash($id, PASSWORD_DEFAULT),
                'email' => $email,
                'pwd' => $pwd,
                'message' => "Donator Exists",
                'uid' => $_SESSION['uid']
            );
            if (password_verify($user->pwd, $pwd) && $user->email == $email){
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
                array('message' => 'Invalid Email Or Password')
            );
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'Invalid Email Or Password')
        );
    }
?>