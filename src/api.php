<?php

$call = explode("/",trim($_SERVER['DOCUMENT_URI'],'/'));
$type = strToUpper($_SERVER['REQUEST_METHOD']);


require_once "types/$call[0].php";

switch($type){
    case 'GET':
        output($call[0]::$call[1].'GET'('a'));
        break;

    case 'POST':

        break;

    case 'PUT':
        
        break;

    case 'DELETE':
        
        break;
}

function output($someData){

}

echo "Calling type: $call[0]<br/>Calling method: $call[1]";

?>
