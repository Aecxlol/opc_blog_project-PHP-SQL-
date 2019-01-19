<?php $title = 'Liste des commentaires'; ?>

<?php ob_start(); //Mémorise toute la sortie html qui suit ?>

<h1>TP BLOG</h1>

<a href="http://localhost/damien/blog_opc/index.php?action=listPosts&amp;page=1">Revenir à la liste des topics</a>
<!-- AFFICHAGE DU COMMENTAIRE -->
<div class="news">
    <h3><?= htmlspecialchars($topic['titre']) ?> le <?= $topic['date'] ?> par <?= $topic['auteur'] ?></h3> 
    <p><?= nl2br(htmlspecialchars($topic['contenu'])) ?><br /><h1>Commentaires</h1></p>
</div>
        
<?php
    /* AFFICHAGE DES COMMENTAIRES */
    while($reqCom = $reqComments->fetch())
    {
?>
        <div class="news">
        <strong><?= htmlspecialchars($reqCom['auteur']) ?></strong> le <?= $reqCom['dateCom'] ?> (<a href="index.php?action=editComment&amp;topic=<?= $_GET['topic'] ?>&amp;commentaire=<?= $reqCom['id'] ?>">modifier</a>)<br />
        <?= nl2br(htmlspecialchars($reqCom['commentaire'])) ?><br /><br />
        </div>
<?php
    }

    $reqComments->closeCursor();
?>
    
<?php
    if(isset($arrayNbPagesComments[0]) && !empty($arrayNbPagesComments[0]) && $test == 1) /*Si aucun commentaire existe pas besoin d'afficher les pages*/
    {
?>
        <p>Page :&nbsp
<?php
        for($i=1;$i<=$arrayNbPagesComments[1];$i++)
        {
            echo '<a href="http://localhost/damien/blog_opc/index.php?action=post&amp;topic='.$_GET['topic'].'&page='.$i.'" class="numPage">'.$i.'</a>';
        }
?>
    </p>
<?php
    }else{
        echo 'Soyez le premier à commenter !';
    }
    
?>
    <hr>
    <br /><h2>Poster un commentaire :</h2>
    <form method="post" action="index.php?action=addComment&amp;topic=<?= $_GET['topic'] ?>&amp;page=1">
        <input type="text" name="author" class="inputNick" placeholder="Pseudo" /><br />
        <textarea rows="10" cols="50" name="comment" class="inputCom" placeholder="Votre message"></textarea><br />
        <input type="submit" name="submit" value="Poster">
    </form>

<?php $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable ?>

<?php require('template.php'); ?>
