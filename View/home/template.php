<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="<?= $description ?>">
        
        <!-- Tag Open Graph pour les aperçus des liens -->
        <meta property="og:title" content=""/>
        <meta property="og:description" content=""/>
        <meta property="og:url" content=""/>
        <meta property="og:type" content="website"/>
        <meta property="og:image" content=""/>
        <meta name="viewport" content="width=device-width" />
        
        <title><?= $title ?></title> <!-- moins de 70 caractère c'est mieux -->
        <link rel="icon" href="">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="public/css/style.css" />
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    </head>
        
    <body>
        <header>
            <?= $header ?>
        </header>
        <div id="page-content">
            <section class="section1">
                <?= $section ?>
            </section>
            <section class="section2">
                <?= $section ?>
            </section>
            <section class="section3">
                <?= $section ?>
            </section>
            <section class="section4">
                <?= $section ?>
            </section>
            <section class="section5">
                <?= $section ?>
            </section>
        </div>
        <footer>
            <?= $footer ?>
        </footer>
        <script src="public/js/functions.js"></script>
        <?= $script ?>
    </body>
</html>