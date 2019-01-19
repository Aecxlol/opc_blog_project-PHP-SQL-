<?php $title = 'Accueil'; ?>

<?php ob_start(); //Mémorise toute la sortie html qui suit ?>

<?php
        if(isset($_SESSION['userName']) && !empty($_SESSION['userName']))
        {
?>
                <p>Bonjour <?= $_SESSION['userName'] ?></p>
                <p><a href="index.php?action=disconnect">Se déconnecter</a>
<?php
                if($_SESSION['status'] == 'admin')
                {
?>
                        <p><a href="index.php?action=adminMenu">Admin pannel</a>    
<?php    
                }
        }else{
?>
                <p><a href="index.php?action=login">Se connecter</a>
<?php
        }
?>

<h1 class="main-title">TP BLOG</h1>
<p>Derniers billets du blog :</p>
        <!--
                Affichage des topics
                Envoi de l'id du topic à commentaire.php pour pouvoir afficher les commentaires en fonction de l'id du topic
                Utilisation de short open tags < ?= ?> pour la visibilité du code. 
                Cela permet d'éviter d'avoir à écrire echo quand on souhaite juste afficher une variable. 
                Le but est d'être plus lisible dans la vue en enlevant le maximum de code PHP là-dedans 
        -->
<?php
        while($topic=$req->fetch()) //Boucle pour afficher tous les topics
        {
?>
            <div class="news">
                <h3><?= htmlspecialchars($topic['titre']) ?> le <?= $topic['date'] ?> par <?= htmlspecialchars($topic['auteur']) ?></h3>
                <p><?= nl2br(htmlspecialchars($topic['contenu'])) ?><br /><a href="http://localhost/damien/blog_opc/index.php?action=post&amp;topic=<?= $topic['id'] ?>&page=1">Commentaires</a></p>
            </div>
<?php
        }        
        $req->closeCursor();
?>
        <p>Page :&nbsp
<?php
        for($i=1;$i<=$nbPages;$i++)//Pour afficher toutes mes pages je fais une boucle de la page 1 au nombre de page totale
        {
?>
            <a href="http://localhost/damien/blog_opc/index.php?action=listPosts&amp;page=<?= $i ?>" class="numPage"><?= $i ?></a>
<?php
        }
?>
        </p>
<?php $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable ?>

<?php require('template.php'); ?>