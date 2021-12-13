#!/usr/bin/php -q
<?php
$outpoot = shell_exec("php db.php sp_login 'user;password'");
echo $outpoot;
?>