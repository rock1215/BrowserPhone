<?php

$data = json_decode(file_get_contents("php://input"));

echo json_encode(array('result' => $data->user));

// $user = $data ;
// $password = $data['password'];

// if (is_null($user) || is_null($password)) {
//     echo json_encode(array('error' => 1, 'message' => $data));
// } else {
//     $outpoot = shell_exec("php ../db.php sp_login '" + $user + ";" + $password + "'");
//     echo $outpoot;
// }

?>