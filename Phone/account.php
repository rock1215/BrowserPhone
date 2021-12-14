<?php

$data = json_decode(file_get_contents("php://input"));

$user = $data->user;
$password = $data->password;
$type = $data->type;
$pincode = $data->pincode;

if (is_null($user)) {
    echo json_encode(array('error' => 1, 'message' => 'Wrong Input!'));
} else {
    if ($type === "login") {
        $outpoot = shell_exec("php ../db.php sp_login '".$user.";".$password."'");
        $result = json_decode($outpoot);

        echo json_encode(array('error' => 0, 'data' => $result[0]));
    } else if ($type === "regist") {
        $outpoot = shell_exec("php ../db.php sp_signup '".$user.";".$password.";".$pincode."'");
        $result = json_decode($outpoot);

        echo json_encode(array('error' => 0, 'data' => $result[0]));
    } else if ($type === "pinset") {
        $outpoot = shell_exec("php ../db.php sp_pin_set '".$user.";".$pincode."'");
        $result = json_decode($outpoot);

        echo json_encode(array('error' => 0, 'data' => $result[0]));
    } else {
        $outpoot = shell_exec("php ../db.php sp_pin_reset '".$user."'");
        $result = json_decode($outpoot);

        echo json_encode(array('error' => 0, 'data' => $result[0]));
    }
}

?>