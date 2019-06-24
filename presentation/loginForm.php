<div id="loginFormWrapper" class="cf">
    <form id="loginForm" method="post" name="loginForm" action="index.php?action=login">
        <div class="row">
            <div class="col"><label for="email" >e-mailadres</label> </div>
           <div class="col"> <input name="email" id="email" placeholder="e-mail" type="text"
                                value="<?php if(isset($_COOKIE["emailadres"])){ print($_COOKIE["emailadres"]); }?>"
                                    > </div>
        </div>
        <div class="row">
           <div class="col"><label for="paswoord" >Wachtwoord</label> </div>
           <div class="col"><input name="paswoord"  type="password"> </div>
            <?php
                if(isset($loginError)&&$loginError){
                    ?>
                    <span class="error" >Foutieve gebruikersnaam en/of wachtwoord!</span>
            <?php
                    unset($loginError);
                }
            ?>
        </div>

        <div class="row">
            <div class="col"><input name="loginButton" type="submit" value="Log in"></div>
        </div>
    </form>
</div>
