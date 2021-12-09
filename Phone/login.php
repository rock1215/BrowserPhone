#!/usr/bin/php -q
<?php
date_default_timezone_set('Africa/Johannesburg');
setlocale(LC_ALL,'en_ZA');
error_reporting(0);



require_once "System/Daemon.php";
System_Daemon::setOption("appName", "gd_rtc_reger");
System_Daemon::setOption("authorEmail", "werner@greydotelecom.com");
System_Daemon::log(System_Daemon::LOG_INFO, "Daemon now starting");
System_Daemon::start();
$data = DwebRTC_DBsql("sp_login('user','1234')");
print_r(array_values($data));
System_Daemon::log(System_Daemon::LOG_INFO, "Daemon: '".System_Daemon::getOption("appName")."' spawned!" );
function DwebRTC_DBsql($sqlToDo) {
    $mysqli = new mysqli('127.0.0.1', 'dragon_php', 'dragon_php2120', 'dragon', 3306);
    mysqli_set_charset($mysqli,'utf8');
    $payload = array();
    if ($result = $mysqli->query($sqlToDo)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_row()) { $payload[count($payload)] = $row; }
        }else{
            $payload[count($payload)] = array('');
        }
    }
    $mysqli->close();
    return $payload;
}
$dir = '/var/www/html/';
$sleepertimesec = '10';
$looprunok = TRUE;
while ($looprunok) {
    exec('/usr/local/bin/showcontacts');
    $file_contacts = explode(PHP_EOL, file_get_contents($dir.'contacts.txt'));
    $file_registrations = explode(PHP_EOL, file_get_contents($dir.'registrations.txt'));
    $list_contacts = array();
    $list_registrations = array();
    for ($i = 0; $i < count($file_contacts); $i++) {
        for ($j = 0; $j < 11; $j++) {
            $file_contacts[$i] = str_replace('  ', ' ', $file_contacts[$i]);
        }
        $file_contacts[$i] = explode(' ', $file_contacts[$i]);
        if (count($file_contacts[$i]) > 3) {
            $tmpx = explode('/',$file_contacts[$i][2]);
            if (substr($tmpx[0], 0,3) == '259') {
                $list_contacts[count($list_contacts)] = $tmpx[0];
            }
        }
    }
    for ($i = 0; $i < count($file_registrations); $i++) {
        for ($j = 0; $j < 11; $j++) {
            $file_registrations[$i] = str_replace('  ', ' ', $file_registrations[$i]);
        }
        $file_registrations[$i] = explode(' ', $file_registrations[$i]);
        if (count($file_registrations[$i]) > 3) {
            $tmpx = explode('/',$file_registrations[$i][2]);
            if (substr($tmpx[0], 0,3) == '259') {
                $list_registrations[count($list_registrations)] = $tmpx[0];
            }
        }
    }
    $list_contacts = array_filter($list_contacts);
    $list_registrations = array_filter($list_registrations);
    if (count($list_contacts) > 0 || count($list_registrations) > 0) {
        $counter = 'NO';
        if (count($list_contacts) == count($list_registrations)) { $counter = 'OK'; }
        if($list_contacts.sort().join(',') === $list_registrations.sort().join(',') && $counter == 'OK'){
            //All Done
        }else{
            $result1 = array_diff($list_contacts, $list_registrations);
            $result2 = array_diff($list_registrations, $list_contacts);
            foreach ($result1 as $regnum) { DwebRTC_DBsql("call greydot_realtime_v2.sp_registration_add('".$regnum."');"); }
            foreach ($result2 as $remnum) { DwebRTC_DBsql("call greydot_realtime_v2.sp_registration_remove('".$remnum."');"); }
        }
    }
    print_r($list_contacts);
    sleep($sleepertimesec);
}


System_Daemon::log(System_Daemon::LOG_INFO, " ====Stoped==== ");
System_Daemon::stop();
?>