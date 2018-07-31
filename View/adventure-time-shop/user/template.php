<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Adventure Time Fake Shop selling merchandise by a fan to honor the greatest TV show on Earth">
        
        <!-- Tag Open Graph pour les aperçus des liens -->
        <meta property="og:title" content="Adventure Time (Fake) Shop"/>
        <meta property="og:description" content="Adventure Time Fake Shop selling merchandise by a fan to honor the greatest TV show on Earth"/>
        <meta property="og:url" content=""/>
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="https://cdn.vox-cdn.com/thumbor/dfkqZ9Pj473t55_tLvbqC5qnuc0=/120x0:1740x1080/1200x800/filters:focal(120x0:1740x1080)/cdn.vox-cdn.com/uploads/chorus_image/image/51104763/adventure_time.0.0.jpg"/>
        <meta name="viewport" content="width=device-width" />
        
        <title><?= $title ?></title> <!-- moins de 70 caractère c'est mieux -->
        <link rel="icon" href="">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="public/css/style-atshop.css" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    </head>
        
    <body>
        <header>
            <?= $header ?>
        </header>
        <?= $section1 ?>
        <footer>
            <?= $footer ?>
        </footer>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="public/js/ajax.js"></script>
        <script src="public/js/function.js"></script>
        <?= $script ?>
    </body>
</html>