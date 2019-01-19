<?php $title = "Déconnecté"; ?>

<?php ob_start(); ?>

<h1>TP BLOG</h1>

<p>Vous avez été déconnecté avec succès</p>
<p><a href="http://localhost/damien/blog_opc/index.php">Revenir à l'accueil</a></p>

<?php $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable ?>

<?php require('template.php'); ?>