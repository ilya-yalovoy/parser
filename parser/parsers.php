<?php
echo "Loaded";
    // pars https://profsale.ru/
    function get_profsafe(string $url) {
        $arr = [
            "name" => null,
            "price" => null,
        ];

        $html = openPage($url);
        echo $html;
        // создаем новый dom-объект
        $dom = new domDocument("1.0", "utf-8");

        // загружаем html в объект
        $dom->loadHTML($html);
        $dom->preserveWhiteSpace = false;
        $counter = 0;
        foreach ($dom->getElementsByTagName('div') as $row)
        {
            
            if ($counter++ == 0) continue;
            if ($row->getAttribute("class") == "price") {
                $str = $row->getAttribute("data-value");
                $str = preg_replace('/\s+/', '', $str);
                $arr["price"] = $str;
                break;
            }
        }

        foreach ($dom->getElementsByTagName('h1') as $row)
        {
            
            if ($counter++ == 0) continue;
            if ($row->getAttribute("id") == "pagetitle") {
                $str = $row->nodeValue;
                $str = preg_replace('/\s+/', '', $str);
                $arr["name"] = $str;
                break;
            }
        }

        return $arr;
    }

    // parse https://xn----7sbenacbbl2bhik1tlb.xn--p1ai/
    function get_GeleznayaMebel(string $url) {
        $arr = [
            "name" => null,
            "price" => null,
        ];

        $html = openPage($url);
        echo $html;
        // создаем новый dom-объект
        $dom = new domDocument("1.0", "utf-8");

        // загружаем html в объект
        $dom->loadHTML($html);
        $dom->preserveWhiteSpace = false;
        $counter = 0;
        foreach ($dom->getElementsByTagName('div') as $row)
        {
            
            if ($counter++ == 0) continue;
            if ($row->getAttribute("id") == "current_price") {
                $str = $row->nodeValue;
                $str = preg_replace('/\s+/', '', $str);
                $arr["price"] = $str;
                break;
            }
        }

        foreach ($dom->getElementsByTagName('h1') as $row)
        {
            
            if ($counter++ == 0) continue;
            if ($row->getAttribute("id") == "pagetitle") {
                $str = $row->nodeValue;
                $str = preg_replace('/\s+/', '', $str);
                $arr["name"] = $str;
                break;
            }
        }

        return $arr;
    }

    function openPage ($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
        return curl_exec($curl);
    }
?>