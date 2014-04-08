<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/04/2014
 * Time: 11:16
 */
?>

<div id="login-box">
    <?php if($loginError): ?>
        <div class="message message-error">
            <?php echo $loginMessage; ?>
        </div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="field">
            <input type="text" name="login_form[pseudo]" id="pseudo"/><label for="pseudo" id="lPseudo">Pseudo</label>
        </div>
        <div class="field">
            <input type="password" name="login_form[password]" id="password"/><label for="password" id="lPassword">Mot de passe</label>
        </div>
        <div class="field">
            <button type="submit">Connexion</button>
        </div>
    </form>
</div>

<script>
    (function(w,d){
        var login = d.querySelector("#pseudo");
        var loginLabel = d.querySelector("#lPseudo");
        var pass = d.querySelector("#password");
        var passLabel = d.querySelector("#lPassword");
        login.addEventListener("keyup", function(e){
            e.preventDefault();
            if(this.value != ""){
                loginLabel.classList.add("small");
            } else {
                loginLabel.classList.remove("small");
            }
        },false);
        pass.addEventListener("keyup", function(e){
            e.preventDefault();
            if(this.value != ""){
                passLabel.classList.add("small");
            } else {
                passLabel.classList.remove("small");
            }
        },false);
    })(window, document);
</script>
