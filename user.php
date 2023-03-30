<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');


require_once('db.php');
$user = new Database();
$api = $_SERVER['REQUEST_METHOD'];
$id = intval($_GET['id'] ?? '');

if($api == "GET"){
    if($id != 0){
        $data = $user->fetch($id);
    }else{
        $data = $user->fetch();
    }
    echo json_encode($data);
}


if($api == "POST"){
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $address = $user->test_input($_POST['address']);
    $phone = $user->test_input($_POST['phone']);

    if($user->insert($name, $email, $address, $phone)){
        echo $user->message("User added Successfully", false);
    }else{
        echo $user->message("Failed to add user", true);
    }
}


if($api == "DELETE"){
    if($id != null){
        if($user->delete($id)){
            echo $user->message("User deleted Successfully", false);
        }else{
            echo $user->message("Failed to delete", true);
        }
    }else{
        echo $user->message("User not found", true);
    }
}

?>