<?php

function is_valid_luhn($number, $checkdate = FALSE) {
    if ($checkdate) {
        $day = substr($number, 0, 2);
        $month = substr($number, 2, 2);
        if ($day < 1 || $day > 31 || $month < 1 || $month > 12) {
            return FALSE;
        }
    }
    settype($number, 'string');
    $sumTable = array(
        array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
        array(0, 2, 4, 6, 8, 1, 3, 5, 7, 9));
    $sum = 0;
    $flip = 0;
    for ($i = strlen($number) - 1; $i >= 0; $i--) {
        $sum += $sumTable[$flip++ & 0x1][$number[$i]];
    }
    return $sum % 10 === 0;
}

$pass = 0;
$fail = 0;

$num_of_amka = 300;

$amkarray = array();
for ($i = 0; $i < $num_of_amka; $i++) {
    $amkarray[$i] = create_random_amka();
}

//$amkarray = array(
//    '11111111111',
//    '22222222222'
//);

function create_random_amka() {
    $amka = '';
    for ($i = 0; $i < 11; $i++) {
        $amka .= rand(0, 9);
    }
    return $amka;
}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Luhn algorithm for AMKA</title>
        <style>
            body{font-family: monospace;}
            .outer{border-right: 1px solid #dddddd;border-bottom: 1px solid #dddddd;padding: 5px 10px;display: inline-block}
            .l{float: left;width: 80%;}
            .r{float: right;width: 20%;}
            .inone{color:#444444;}
            .intwo{color:#333333;}
            .pass{background-color:#dff0d8;color:#3c763d;font-weight: bold;border:2px solid #d6e9c6;text-align:center;}
            .fail{background-color:#f2dede;color:#a94442;border:2px solid #ebccd1;text-align:center;}
            .p{font-size: 4em;clear: both;border: 1px solid #dddddd;padding: 5px;}
            .lek{font-size: 50%;}
        </style>
    </head>
    <body>
        <div class="content">
            <?php
            echo '<div class="l">';
            foreach ($amkarray as $i => $value) {
                is_valid_luhn($amkarray[$i]) ? $pass++ : $fail++;
                echo '<div class="outer"><div class="inone">' . $amkarray[$i] . '</div><div class="intwo ';
                echo is_valid_luhn($amkarray[$i]) ? 'pass">TRUE' : 'fail">FALSE';
                echo '</div></div>';
            }
            echo '</div><div class="r">';
            echo '<div class="p"><span class="lek">AMKA passed:</span><br>' . number_format((float) (($pass * 100) / ($pass + $fail)), 2, ',', '') . '%</div>';
            echo '</div>';
            ?>
        </div>
    </body>
</html>