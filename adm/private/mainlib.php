<?php
/**
 * Main Lib AutoIncluded by the Controller
 */


/**
 * Manage PHP Errors
 *
 * @param $errno
 * @param $errstr
 * @param $errfile
 * @param $errline
 */

function myErrorHandler($errno, $errstr, $errfile, $errline) {
    $show = 1;
    switch ($errno) {
        case E_NOTICE :
        case E_USER_NOTICE :
            $errors = "Notice";
        $show = 0;
            break;
        case E_WARNING :
        case E_USER_WARNING :
            $errors = "Warning";
        $show = 1;
            break;
        case E_ERROR :
            $errors = "E_ERROR";
            break;
        case E_USER_ERROR :
            $errors = "Fatal Error";
            break;
        case 8192 :
// Deprecated
            $show = 1;
            break;

        case 2048 :
            $errors = "DEPRECATED";

            break;
        default :
            $errors = "Unknown (" . $errno . ")";
            break;
    }

    if ($show == 1) {
        echo messaggio ( "warning", "<b>(" . $errno . ")Linea: " . $errline . " " . $errfile . "</b><pre>" . $errstr . "</pre><br>" );
    }
}

function messaggio($type="info",$STR){
    echo "<div class='".$type."'>".$STR."</div>";
}

function redirect($URL,$SECONDS=0){
    print '<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">';
    print '<META HTTP-EQUIV="REFRESH" CONTENT="'.$SECONDS.';URL='.$URL.'">';
    print '<html><h4><a href='.$URL.'>Done</h4></html>';
    die();
}
?>