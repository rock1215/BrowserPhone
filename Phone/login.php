<?php

$_POST = json_decode(file_get_contents("php://input"), true);

$user = $_POST['user'];
$password = $_POST['password'];

if (is_null($user) || is_null($password)) {
    echo json_encode(array('error' => 1, 'message' => $_POST));
} else {
    $outpoot = shell_exec("php ../db.php sp_login '" + $user + ";" + $password + "'");
    echo $outpoot;
}

?>