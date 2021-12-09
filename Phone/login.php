<?php
require_once 'PHPGangsta/GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();

$qrCodeUrl = $ga->getQRCodeGoogleUrl('WWWCall.me', $secret);

// $oneCode = $ga->getCode($secret);
// echo "Checking Code '$oneCode' and Secret '$secret':\n";

// $checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
// if ($checkResult) {
//     echo 'OK';
// } else {
//     echo 'FAILED';
// }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Browser Phone</title>
        <meta name="description" content="Browser Phone is a fully featured browser based WebRTC SIP phone for Asterisk. Designed to work with Asterisk PBX. It will connect to Asterisk PBX via web socket, and register an extension.  Calls are made between contacts, and a full call detail is saved. Audio and Video Calls can be recorded locally.">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
        <meta name="HandheldFriendly" content="true">

        <meta name="format-detection" content="telephone=no"/>
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE"/>
        <meta name="apple-mobile-web-app-capabale" content="yes"/>
        
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
        <meta http-equiv="Expires" content="0"/>

        <link rel="icon" href="favicon.ico">

        <link rel="stylesheet" type="text/css" href="https://dtd6jl0d42sve.cloudfront.net/lib/Normalize/normalize-v8.0.1.css"/>
        <link rel="stylesheet" type="text/css" href="https://dtd6jl0d42sve.cloudfront.net/lib/fonts/font_roboto/roboto.css"/>
        <link rel="stylesheet" type="text/css" href="https://dtd6jl0d42sve.cloudfront.net/lib/fonts/font_awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery-ui.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://dtd6jl0d42sve.cloudfront.net/lib/Croppie/Croppie-2.6.4/croppie.css"/>
        <link rel="stylesheet" type="text/css" href="phone.css"/>

        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery.md5-min.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/Chart/Chart.bundle-2.7.2.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/SipJS/sip-0.20.0.min.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/FabricJS/fabric-2.4.6.min.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/Moment/moment-with-locales-2.24.0.min.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/Croppie/Croppie-2.6.4/croppie.min.js"></script>
        <script type="text/javascript" src="https://dtd6jl0d42sve.cloudfront.net/lib/XMPP/strophe-1.4.1.umd.min.js"></script>
    </head>

    <body>
        <div id="actionArea" style class="contaceArea cleanScroller">
            <img src=<?php echo $qrCodeUrl; ?> />
            <input id="SecretCode" class="UiInputText" type="number"/>
            <div class="UIWindowButtonBar" id="ButtonBar">
                <button>Check</button>
            </div>
        </div>
    </body>
</html>

