<?php

 /**
 * Created with ♥ by Verlikylos on 21.03.2017 22:51.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
 */

function getSmsNumbers($smsOperator) {

    switch ($smsOperator) {
        case ("MicroSMS"):
            return array('71480' => 1, '72480' => 2, '73480' => 3, '74480' => 4, '75480' => 5, '76480' => 6, '79480' => 9, '91400' => 14, '91900' => 19, '92022' => 20, '92521' => 25);
        case ("LvlUp"):
            return array('70068' => 0.5, '71068' => 1, '72068' => 2, '74068' => 4, '76068' => 6, '91058' => 10, "91758" => 17, '92058' => 20, '92578' => 25);
        case("Homepay"):
            return array('7155' => 1, '7255' => 2, '7355' => 3, '7455' => 4, '7555' => 5, '76660' => 6, '77550' => 7, '7955' => 9, '91055' => 10, '91155' => 11, '91455' => 14, '91955' => 19, '92055' => 20, '92520' => 25, '92525' => 25);
        case("Pukawka"):
            return array('71480' => 1, '72480' => 2, '73480' => 3, '74480' => 4, '75480' => 5, '76480' => 6, '79480' => 9, '91400' => 14, '91900' => 19, '92550' => 25);
        default:
            return null;
    }

}

function getPriceNetto($number, $smsOperator) {
    $numbers = getSmsNumbers($smsOperator);
    foreach ($numbers as $numb => $cost) {
        if ($numb == $number) return $cost;
    }
    return null;
}

function getPriceBrutto($number, $smsOperator) {
    foreach (getSmsNumbers($smsOperator) as $numb => $cost) {
        if ($numb == $number) return round(($cost + (0.23 * $cost)), 2);
    }
    return null;
}
