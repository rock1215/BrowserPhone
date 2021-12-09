<?php
require_once 'PHPGangsta/GoogleAuthenticator.php';



$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();

$qrCodeUrl = $ga->getQRCodeGoogleUrl('WWWCall.me', $secret);

$oneCode = $ga->getCode($secret);
echo "Checking Code '$oneCode' and Secret '$secret':\n";

$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
if ($checkResult) {
    echo 'OK';
} else {
    echo 'FAILED';
}