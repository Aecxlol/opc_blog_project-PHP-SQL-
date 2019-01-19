<?php $title = 'Menu d\'administration'; ?>

<?php ob_start(); //Mémorise toute la sortie html qui suit ?>

<h1>TP BLOG</h1>
<?php
    if(isset($_SESSION['userName']) AND !empty($_SESSION['userName']))
    {
        if($_SESSION['status'] == 'admin')
        {
?>
            <p>Bonjour <strong><?= $_SESSION['userName'] ?></strong>.</p>
            <p>Que voulez vous faire ?</p>

            <a href="index.php?action=adminAddTopic">Ajouter un topic</a><br />
            <a href="index.php?action=adminEditTopic&amp;page=1">Editer un topic</a><br /><br />
            <a href="index.php"> Se rendre sur le blog</a><br />
            <a href="index.php?action=disconnect">Se deconnecter</a>
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