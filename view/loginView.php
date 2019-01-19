<?php $title = 'Se connecter'; ?>

<?php ob_start(); //Mémorise toute la sortie html qui suit ?>

<h1>SE CONNECTER</h1>
<form method="POST" action="index.php?action=connexion">
    <input type="text" name="userName" placeholder="Username" /><br /><br />
    <input type="password" name="passwd" placeholder="Mot de passe" /><br /><br />
    <input type="submit" /><br /><br />
</form>

<a href="index.php?action=signUpHome">S'inscrire</a><br />
<a href="index.php">Se rendre sur le blog</a>

<?php $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable ?>

<?php require('template.php'); ?>