<?php $title = 'Modifier un commentaire'; ?>

<?php ob_start(); ?>

<h1>TP BLOG</h1>

<?php 
    $oneCom = $reqGetOneCom->fetch(); 
?>

<div class="news">
    <strong><?= htmlspecialchars($oneCom['auteur']) ?></strong> le <?= $oneCom['dateCom'] ?><br /><br />
    Commentaire que vous voulez modifier : <?= nl2br(htmlspecialchars($oneCom['commentaire'])) ?><br />
</div>

<p>Par</p>

<form method="post" action="index.php?action=commentEdited&amp;idCom=<?= $_GET['commentaire'] ?>&amp;topic=<?= $_GET['topic'] ?>">
    <textarea rows="10" cols="50" name="commentToEdit" class="inputCom" placeholder="Nouveau commentaire"></textarea><br />
    <input type="submit" value="Modifier" />
</form>

<p><a href="index.php?action=post&amp;topic=<?= $_GET['topic'] ?>&amp;page=1">Revenir au topic</a></p>

<?php $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable ?>

<?php require('template.php'); ?>