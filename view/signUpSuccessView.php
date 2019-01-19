<?php $title = 'Identifiants créés'; ?>

<?php ob_start(); //Mémorise toute la sortie html qui suit ?>

<h1>TP BLOG</h1>

<p>Votre inscription a été validée.</p>

<p><a href="index.php">Revenir au menu</a></p>

<?php $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable ?>

<?php require('view/template.php'); ?>