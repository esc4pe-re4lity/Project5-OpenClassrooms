<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="cv fiamma pellicane web developper">
        
        <!-- Tag Open Graph pour les aperçus des liens -->
        <meta property="og:title" content=""/>
        <meta property="og:description" content=""/>
        <meta property="og:url" content=""/>
        <meta property="og:type" content="website"/>
        <meta property="og:image" content=""/>
        <meta name="viewport" content="width=device-width" />
        
        <title>Fiamma Pellicane - Home</title> <!-- moins de 70 caractère c'est mieux -->
        <link rel="icon" href="">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="public/css/style-home.css" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    </head>
        
    <body>
        <header>
            <?php require ('header.php'); ?>
        </header>
        <div id="page-content">
            <?php require ('aboutMe.php'); ?>
            <?php require ('adventureTimeShop.php'); ?>
            <?php require ('travels.php'); ?>
            <?php require ('OC.php'); ?>
            <?php require ('contactMe.php'); ?>
        </div>
        <footer>
            <?php require ('footer.php'); ?>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="Public/js/home/aboutMe.js"></script>
        <script src="Public/js/home/menu.js"></script>
        <script src="Public/js/home/main.js"></script>
    </body>
</html>