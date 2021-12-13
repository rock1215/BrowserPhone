<?php

$outpoot = shell_exec("php ../db.php sp_login 'test;password'");
echo $outpoot;

?>