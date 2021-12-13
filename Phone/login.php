<?php

$user = $_POST['user'];
$password = $_POST['password'];

if (is_null($user) || is_null($password)) {
    echo json_decode('{"error": "Wrong Input"}');
} else {
    $outpoot = shell_exec("php ../db.php sp_login '" + $user + ";" + $password + "'");
    echo $outpoot;
}

?>