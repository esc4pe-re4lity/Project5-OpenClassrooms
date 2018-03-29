<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form class="login" method="post" action="index.php?action=createAccount">
            <p>
                <label for="pseudo">Pseudo</label>
                <br/>
                <input type="text" name="pseudo" id="pseudo" required/>
            </p>
            <p>
                <label for="email">Email</label>
                <br/>
                <input type="text" name="email" id="email" required/>
            </p>
            <p>
                <label for="password">Créez un mot de passe</label>
                <br/>
                <input type="password" name="password" id="password" required/>
            </p>
            <p>
                <label for="confirmPassword">Confirmez votre mot de passe</label>
                <br/>
                <input type="password" name="confirmPassword" id="confirmPassword" required/>
            </p>
            <p>
                <span id="info"></span>
            </p>
            <p>
                <input class="button" type="submit" value="Envoyer"/>
            </p>
            <p>Vous avez déjà un compte ? Cliquez <a class="hover bold" href="index.php?action=login">ici</a></p>
        </form>
    </body>
</html>
