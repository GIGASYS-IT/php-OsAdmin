<?php
/**
 * Login Page
 *
 * This page does not requires auth
 */
?>

<form id="login" action='' method=post>
    <input type=hidden name=page value="<?php echo $_REQUEST['page'] ?>">
    <input type=hidden name=action value="login">
    <div class="inputwrapper login-alert">
        <div class="alert alert-error">Invalid username or password</div>
    </div>
    <div class="userinfo">
                <input type="text" name="user" id="user"
                       placeholder="Nome Utente" />

                <input type="password" name="pass" id="pass"
                       placeholder="Password"
                       autocomplete='off' />
                <button name="submit">Login</button>
</form>