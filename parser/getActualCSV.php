<?php

require_once('./db.php');
$arr = actionData('SELECT * FROM `catalog`', "get");

$name = time();
header("Content-type: text/csv"); 
header("Content-Disposition: attachment; filename=tableCatalog{$name}.csv"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 

$buffer = fopen('php://output', 'w'); 
fputs($buffer, chr(0xEF) . chr(0xBB) . chr(0xBF)); 
fputcsv($buffer, [
    "Наименование",
    "Цена",
    "Ссылка на товар в profsale.ru",
    "Цена в profsale.ru",
    "Ссылка на товар в железная-мебель.рф",
    "Цена в железная-мебель.рф"
], ';'); 
foreach ($arr as $key => $value) {
    fputcsv($buffer, [$value[0],$value[1],$value[2],$value[3],$value[4],$value[5]], ';');
}
fclose($buffer);
exit();
?>