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
            <p>Editer ce topic</p>

            <div class="news">
                <h3><?= htmlspecialchars($topic['titre']) ?> le <?= $topic['date'] ?> par <?= $topic['auteur'] ?></h3>
                <p><?= nl2br(htmlspecialchars($topic['contenu'])) ?><br /></p>
            </div>

            <p>Par</p>

            <form method="POST" action="index.php?action=editTopic&amp;topic=<?= $_GET['topic'] ?>">
                <input type="text" name="newTopicTitle" placeholder="Nouveau titre" /><br /><br />
                <textarea rows="10" cols="50" name="newTopicContent" class="inputCom" placeholder="Contenu du topic"></textarea><br />
                <input type="hidden" value="<?= $_GET['topic'] ?>" name="idTopic" />
                <input type="submit" name="Modifier" value="Modifier" />
            </form>
            <p><a href="index.php?action=adminMenu">Revenir au menu</a></p>
<?php
        }else{
            throw new Exception('Accès refusé');
        }
    }else{
        throw new Exception('Accès refusé');
    }

    $content = ob_get_clean(); //Récupère ce que ob_start() a mémorisé. Ca sert juste à mettre du code html dans une variable

    require('view/template.php'); 
?>