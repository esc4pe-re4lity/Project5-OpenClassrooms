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
        <form class="login" method="post" action="index.php?action=login">
            <p>
                <label for="pseudo">Pseudo</label>
                <br/>
                <input type="texte" name="pseudo" id="pseudo" required/>
            </p>
            <p>
                <label for="password">Mot de passe</label>
                <br/>
                <input type="password" name="password" id="password" required/>
            </p>
            <p>
                <input class="button" type="submit" value="Connexion"/>
            </p>
            <p>Vous n'êtes pas encore membre ? Cliquez <a class="hover bold" href="index.php?action=createAccount">ici</a></p>
        </form>
    </body>
</html>
