<?php

    $prods = json_decode(file_get_contents('structureXLSForm.json'), true);
    

    $name = time();
    header("Content-type: text/csv"); 
    header("Content-Disposition: attachment; filename=tableCatalog{$name}.csv"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    
    $buffer = fopen('php://output', 'w'); 
    fputs($buffer, chr(0xEF) . chr(0xBB) . chr(0xBF)); 
    fclose($buffer); 
    exit();

?>