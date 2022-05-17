<?php
try {
    require_once('./csv.php');
    require_once('./db.php');
    require_once('./parsers.php');
    ignore_user_abort(true);
    set_time_limit(0);

    if ($_FILES && $_FILES["filename"]["error"] != UPLOAD_ERR_OK)
    {
        echo 'Error <a onclick="javascript:history.back(-2); return false;">Назад</a>';
        exit();
    } else {
        //echo 'Error <script>history.back(-2); return false;</script>';
    }



    $name = "upload/" . $_FILES["filename"]["name"];
    move_uploaded_file($_FILES["filename"]["tmp_name"], $name);

    $fileContent = kama_parse_csv_file($_FILES["filename"]["tmp_name"]);

    array_shift($fileContent);

    foreach ($fileContent as $key => $value) {
        $fileContent[$key][3] = get_GeleznayaMebel($value[2])["price"];
        $fileContent[$key][5] = get_Profsafe($value[4])["price"];
        $value[3] = get_GeleznayaMebel($value[2])["price"];
        $value[5] = get_Profsafe($value[4])["price"];
        if (actionData('SELECT * FROM `catalog` WHERE `Name` = "'.$value[0].'"', "get") == null) {
            actionData("INSERT INTO `catalog`(`Name`, `PriceMain`, `Link1`, `Price1`, `Link2`, `Price2`) VALUES ('{$value[0]}','{$value[1]}','{$value[2]}','{$value[3]}','{$value[4]}','{$value[5]}')", "new");
        } else {
            actionData("UPDATE `catalog` SET `PriceMain`='{$value[1]}',`Link1`='{$value[2]}',`Price1`='{$value[3]}',`Link2`='{$value[4]}',`Price2`='{$value[5]}' WHERE `Name`='{$value[0]}'", "new");
        }
    }
} catch (\Throwable $th) {
    file_put_contents("error.txt", file_get_contents("error.txt")."\n".$th);
}

?>