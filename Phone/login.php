<?php

$data = json_decode(file_get_contents("php://input"));

$user = 'test';//$data->user;
$password = 'password'; //$data->password;

if (is_null($user) || is_null($password)) {
    echo json_encode(array('error' => 1, 'message' => 'Wrong Input!'));
} else {
    $outpoot = shell_exec("php ../db.php sp_login '".$user.";".$password."'");
    echo $outpoot;
}

?>