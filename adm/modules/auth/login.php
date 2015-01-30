<?php
/**
 * Login Page
 *
 * This page does not requires auth
 */

// INCLUDE THE HEAD SECTION FOR THE SELECTED THEME

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Default CSS common to every theme -->
    <link rel="stylesheet" href="/style/common-css/common.css">
<?php
include_once($THEME."head.php");
?>
</head>
<body class="loginpage" style="background-color:#333333">
<style>
    .centrato {
        width: 270px;
        margin-left: auto;
        margin-top: 100px;
        margin-right: auto;
        color: #FFFFFF;
    }
</style>
<div class="centrato">

<div class="container">
<div class=" span3">
<form class="form-signin" id="login" action='' method=post>
    <h2 class="form-signin-heading">Please sign in</h2>
    <input type=hidden name=page value="<?php echo $_REQUEST['page'] ?>">
    <input type=hidden name=action value="login">


                <input type="text" name="user" id="user" class="form-control"
                       placeholder="Nome Utente" />

                <input type="password" name="pass" id="pass"  class="form-control"
                       placeholder="Password"
                       autocomplete='off' />
                <button name="submit" class="btn btn-lg btn-primary btn-block" >Login</button>
</form>
    </div>
</div>
    </div>
</body>
</html>