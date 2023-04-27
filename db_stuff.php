<?php
    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "zaq1@WSX";
    $dbName = "pizzeria";

    function caesarShift($str, $amount) {
        if ($amount < 0)
            return caesarShift($str, $amount + 26);

        $output = [];

        for ($i = 0; $i < strlen($str); $i++) {
            $c = $str[$i];

            if (preg_match("/[a-z]/i", $c)) {
                $code = ord($str[$i]);

                if ($code >= 65 && $code <= 90)
                    $c = chr((($code - 65 + $amount) % 26) + 65);
                elseif ($code >= 97 && $code <= 122)
                    $c = chr((($code - 97 + $amount) % 26) + 97);
            }
            
            $output[] = $c;
        }
        return implode('', $output);
    }
?>