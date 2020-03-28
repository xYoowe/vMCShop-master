<?php
/**
 * Created with ♥ by Verlikylos on 13.08.2017 23:49.
 * Visit www.verlikylos.pro for more.
 * Copyright © vMCShop 2017
 */

require APPPATH.'libraries/SourceQuery/bootstrap.php';

function rconCommand($commands, $player, $ip, $rconPort, $rconPass) {
    $Query = new \xPaw\SourceQuery\SourceQuery();
    
    try {
        $Query->Connect($ip, $rconPort, 1, \xPaw\SourceQuery\SourceQuery::SOURCE);
        
        $Query->SetRconPassword($rconPass);
        
        foreach ($commands as $command) {
            $Query->Rcon(str_replace('{PLAYER}', $player, $command));
        }
    
        return array('value' => true, 'message' => 'Polecenia zostały pomyślnie wysłane na serwer');
    } catch (Exception $e) {
        return array('value' => false, 'message' => 'Wystąpił błąd podczas komunikacji z serwerem!');
    } finally {
        $Query->Disconnect();
    }
}