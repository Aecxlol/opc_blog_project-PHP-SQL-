<?php $title = 'Modifier un commentaire'; ?>

<?php ob_start(); ?>

<h1>TP BLOG</h1>

<p>Votre commentaire a bien été modifié.</p>
<p><a href="index.php?action=post&amp;topic=<?= $_GET['topic'] ?>&amp;page=1">Voir</a></p>

<?php $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable ?>

<?php require('template.php'); ?>