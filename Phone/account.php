<?php

$data = json_decode(file_get_contents("php://input"));

$user = $data->user;
$password = $data->password;
$type = $data->type;
$pincode = $data->pincode;

if (is_null($user) || is_null($password)) {
    echo json_encode(array('error' => 1, 'message' => 'Wrong Input!'));
} else {
    $outpoot = shell_exec("php ../db.php sp_login '".$user.";".$password."'");
    $result = json_decode($outpoot);

    echo json_encode(array('error' => 0, 'data' => $result[0]));
}

?>