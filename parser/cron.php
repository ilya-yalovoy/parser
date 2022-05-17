<?php
require_once('./db.php');
require_once('./parsers.php');
ignore_user_abort(true);
set_time_limit(0);
$time = time();
cron();

function cron() {
    $arrInMySQL = actionData('SELECT * FROM `catalog`', "get");
    if ($arrInMySQL != 0) {
        foreach ($arrInMySQL as $key => $value) {
            $value[3] = get_GeleznayaMebel($value[2])["price"];
            $value[5] = get_Profsafe($value[4])["price"];
            actionData("UPDATE `catalog` SET `Price1`='{$value[3]}', `Price2`='{$value[5]}' WHERE `Name`='{$value[0]}'", "new");
            print_r($value);
        }
    }
}

while (true) {
    $t = json_decode(file_get_contents("setting.json"), TRUE)["time_work_cron"];
    if (time() - $time >= $t) {
        $time = time();
        cron();
        $a = json_decode(file_get_contents("setting.json"), TRUE);
        $a['time_work_cron'] = time() - $time;
        file_put_contents("setting.json", json_encode($a));
    }
}
    
?>