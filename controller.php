<?php
/**
 * Created by PhpStorm.
 * User: giga
 * Date: 26/01/15
 * Time: 15.57
 */
session_start();
error_reporting(E_ALL);
$ROOT="/adm/";
$APP="adm/modules/";
$INCLUDE="amd/include/";
$PRIV="adm/private/";
$MODULE="";

include_once("adm/private/mainlib.php");
set_error_handler("myErrorHandler");

$MODULE = ""; /* URL of current module 'automatic filled later eg: /adm/auth' */

$ajax = strrpos ( $_REQUEST ['module'], "ajax_" );
$javascript = strrpos($_REQUEST ['module'], ".js");

$apinoauth = strrpos ( $_REQUEST ['module'], "noauth_" );
$api = strrpos ( $_REQUEST ['module'], "-" );
if ($apinoauth != "") {
    $api = " ";
}

/*
* SISTEMA IL LOAD DELLE CLASSI
*/

$_REQUEST ['module'] = str_replace ( "/index", "", $_REQUEST ['module'] );

$page = explode ( "/", $_REQUEST ['module'] );

// SE ARRIVA DA RICHIESTA SBLOCCO
$redirect_to = "";
if (isset ( $_REQUEST ['redirect_to'] )) {
    $redirect_to = "&redirect_to=" . $_REQUEST ['redirect_to'];
// echo messaggio("debug", htmlspecialchars($vaia));
}
;

// VARIABILE PER PARAMETRI EXTRA DEL REDIRECT
$extra_url = "";
// RICHIESTA AGGIUNTA add_site AI SITI SEMPRE CONCESSI NEL GRUPPO filter_group
if (isset ( $_REQUEST ['add_site'] )) {
    if (strpos ( $_REQUEST ['add_site'], "://" )) {
        $APP_ADD_SITE = explode ( "/", $_REQUEST ['add_site'] );
        $ADD_SITE = $APP_ADD_SITE [2];
    } else {
        $ADD_SITE = $_REQUEST ['add_site'];
    }
    $extra_url = "&add_site=" . $ADD_SITE . "&filter_group=" . $_REQUEST ['filter_group'];
}

$pagina = $APP . $page [0];

$MODULE = $ROOT . $page [0] . "/";

$sub_pagina = "";
if ($page [1] != "") {
    $sub_pagina .= "/" . $page [1];
}

if (! empty ( $page [2] )) {
    $sub_pagina .= "/" . $page [2];
}

if ($sub_pagina == "") {
    $pagina .= "/index.php";
} else {

    $pos = strrpos ( $sub_pagina, '.zip' );
    if ($pos === false) {
        $pagina .= $sub_pagina . ".php";
    } else {
        $pagina .= $sub_pagina;
// Download ZIP File
        header ( 'Content-Description: File Transfer' );
        header ( 'Content-Type: application/octet-stream' );
        header ( 'Content-Disposition: attachment; filename="' . $sub_pagina . '"' );
        header ( 'Content-Transfer-Encoding: binary' );
        header ( 'Connection: Keep-Alive' );
        header ( 'Expires: 0' );
        header ( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
        header ( 'Pragma: public' );
        header ( "Content-Length: " . filesize ( $pagina ) );
        ob_clean ();
        flush ();
        readfile ( $pagina );
        die ();
    }
}

if (! isset ( $_REQUEST ['module'] )) {
    /* NO PAGE SELECTED ... NO AUTH REQUIRED */
    include ($PRIV . "head.php");
} else {

    /* LOAD AUTH & HEADER */
    if ($_REQUEST ['module'] != "auth/login/") {
        if (! isset ( $_SESSION ['username'] )) {
            if ($api === false) {
                /* REDIRECT TO LOGIN PAGE */
                redirect ( $ROOT . 'auth/login/&page=' . $_SERVER ['REQUEST_URI'] . $redirect_to . $extra_url );

                die ();
            }
        }
    }

    if ($ajax === false && $api === false && $javascript === false) {
        if ($_REQUEST ['module'] != "auth/login/") {
            /* NOT AJAX PAGE */
            include ($PRIV . "head.php");
        }
    }
}

if ($javascript == true) {
    /* its a normal JS*/
    $pagina = str_replace(".php", "", $pagina);
}

if (! file_exists ( $pagina )) {
    echo messaggio ( "error", "<h1>" . $pagina . " module does not exist </h1>" );
} else {
    /* LOAD CONTROLLER  IF EXISTS */
    $MVCcontroller = substr ( $pagina, 0, - 4 ) . ".controller.php";
    if (file_exists ( $MVCcontroller )) {
        include ($MVCcontroller);
    } else {
        // $errmsg .= "<!-- no MVC controller " . $MVCcontroller . " -->";
    }

    include ($pagina);
}

// echo $_SERVER['QUERY_STRING'];

/* SHOW ERROR IF ANY */
if (isset ( $errmsg )) {
    echo $errmsg;
}

/* LOAD FOOTER IF NOT AJAX OR API */
if ($ajax === false && $api === false && $javascript === false) {
    if ($_REQUEST ['module'] != "auth/login/") {
        include ($PRIV . "foot.php");
    }
}

?>