<?php $title = 'Editer un topic'; ?>

<?php ob_start(); //Mémorise toute la sortie html qui suit ?>

<h1>TP BLOG : EDITER UN TOPIC</h1>
<?php
    if(isset($_SESSION['userName']) AND !empty($_SESSION['userName']))
    {
        if($_SESSION['status'] == 'admin')
        {
?>
            <p>Bonjour <strong><?= $_SESSION['userName'] ?></strong>.</p>
            <p>Quel topic souhaitez-vous editer ?</p>
<?php
            while($topic=$req->fetch()) //Boucle pour afficher tous les topics
            {
    ?>
                <div class="news">
                    <h3><?= htmlspecialchars($topic['titre']) ?> le <?= $topic['date'] ?> par <?= htmlspecialchars($topic['auteur']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($topic['contenu'])) ?><br />
                    <div class="linksEdit">
                        <a class="editLink" href="http://localhost/damien/blog_opc/index.php?action=displaySelectedTopic&amp;topic=<?= $topic['id'] ?>"><strong>EDITER</strong></a>
                        <a class="deleteLink" href="http://localhost/damien/blog_opc/index.php?action=deleteTopic&amp;topic=<?= $topic['id'] ?>&page=1"><strong>SUPPRIMER</strong></a></p>
                    </div>
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
                <a href="http://localhost/damien/blog_opc/index.php?action=adminEditTopic&amp;page=<?= $i ?>" class="numPage"><?= $i ?></a>
<?php
            }
?>
            </p>
            <p><a href="index.php?action=adminMenu">Revenir au menu</a></p>
<?php
        }else{
            throw new Exception('Accès  refusé');
        }
    }else{
        throw new Exception('Accès  refusé');
    }

    $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable

    require('view/template.php'); 
?>