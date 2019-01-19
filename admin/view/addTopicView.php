<?php $title = 'Ajouter un topic'; ?>

<?php ob_start(); //Mémorise toute la sortie html qui suit ?>

<h1>TP BLOG : AJOUTER UN TOPIC</h1>
<?php
    if(isset($_SESSION['userName']) AND !empty($_SESSION['userName']))
    {
        if($_SESSION['status'] == 'admin')
        {
?>
            <p>Bonjour <strong><?= $_SESSION['userName'] ?></strong>.</p>
            <p>Ajout d'un topic</p>

            <form method="POST" action="index.php?action=addTopic">
                <input type="text" name="topicTitle" placeholder="Titre" /><br /><br />
                <textarea rows="10" cols="50" name="contentTitle" class="inputCom" placeholder="Contenu"></textarea><br />
                <input type="hidden" value="1" name="mode" /><!-- J'envoie un paramètre hidden à manip_base.php pour savoir quelle opération faire (ajouter, modifier ou supprimer)-->
                <input type="submit" name="Envoyer" />
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