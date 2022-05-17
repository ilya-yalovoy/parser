<?php
echo file_get_contents('https://profsafe.ru/safes/furniture-safes/seyfyi-Aiko/seyf-Aiko-TSN50.html');
$curl = curl_init('https://profsafe.ru/safes/furniture-safes/seyfyi-Aiko/seyf-Aiko-TSN50.html');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
        curl_setopt($curl, CURLOPT_USERAGENT, $config['useragent']);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
        echo curl_exec($curl);
?>