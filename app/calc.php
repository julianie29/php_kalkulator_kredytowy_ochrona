<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';

function getParams(&$value,&$time, &$interest){
    $value = isset($_REQUEST ['value']) ? $_REQUEST['value'] : null;
    $time = isset($_REQUEST ['time']) ? $_REQUEST['time'] : null;
    $interest = isset($_REQUEST ['interest']) ? $_REQUEST['interest'] : null;
}

function validate(&$value,&$time, &$interest, &$messages){

    if (!(isset($value) && isset($time) && isset($interest))) {
        return false;
    }

    if ($value == "") {
        $messages [] = 'Nie podano kwoty kredytu';
    }
    if ($time == "") {
        $messages [] = 'Nie podano czasu kredytowania';
    }
    if ($interest == "") {
        $messages [] = 'Nie podano oprocentowania';
    }


    if (count($messages) > 0) return false;

        if (!is_numeric($value)) {
            $messages [] = 'Kwota kredytu nie jest liczbą';
        }

        if (!is_numeric($time)) {
            $messages [] = 'Okres kredytowania nie jest liczbą';
        }

        if (!is_numeric($interest)) {
            $messages [] = 'Oprocentowanie nie jest liczbą';
        }

        if (count($messages) != 0) return false;
        else return true;
}

function process(&$value,&$time, &$interest, &$messages, &$result){
    global $role;


    //konwersja parametrów na float
    $value = floatval($value);
    $time = floatval($time);
    $interest = floatval($interest);


    if (($role == 'user' )){
        $result = (($value*(100+$interest))/100)/($time*12);
    }
    else {
        $messages [] = 'Administrator nie może wykonywać obliczeń.';
    }
}

$value = null;
$time = null;
$interest = null;
$result = null;
$messages = array();

getParams($value, $time, $interest);

if (validate($value,$time, $interest, $messages)){
    process($value, $time, $interest, $messages, $result);
}

include 'calc_view.php';

