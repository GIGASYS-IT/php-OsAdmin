<?php
/**
 * HEAD IF EVERY PAGE
 * User: giga
 * Date: 26/01/15
 * Time: 16.23
 */

ob_implicit_flush ();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    $PROTO = "http://";
    if (! empty ( $_SERVER ['HTTPS'] )) { $PROTO = "https://"; }
    if (empty($MODULE)) { $MODULE = ""; }
    ?>
    <base href="<?php echo $PROTO.$_SERVER['HTTP_HOST'].$MODULE; ?>" />

    <!-- Default CSS common to every theme -->
    <link rel="stylesheet" href="/style/common-css/common.css">
</head>


<?php
// include common css

// INCLUDE THE HEAD SECTION FOR THE SELECTED THEME
include_once($THEME."head.php");

?>