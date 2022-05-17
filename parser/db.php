<?php

    function actionData($str, $action) {
        $db_array = file_get_contents("./setting.json");
        $db_array = json_decode($db_array, true);
        $link = mysqli_connect($db_array["db_host"], 
                               $db_array["db_user"], 
                               $db_array["db_password"], 
                               $db_array["db_name"]);
        if (!$link) {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit;
        }

        switch ($action) {
            case 'get':
                $arr = [];
                if($result = mysqli_query($link, $str)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $arr[] = $row;
                        }
                        // Доступный набор результатов
                        mysqli_free_result($result);
                        return $arr;
                    } else{
                        return null; 
                    }
                } 
                
                // Закрыть соединение
                mysqli_close($link);
                break;
            case "update":
                $sql = mysqli_query($link, $str);
                break;
            case "new":
                $sql = mysqli_query($link, $str);
                break;
            default:
                # code...
                break;
        }
    }

    

?>