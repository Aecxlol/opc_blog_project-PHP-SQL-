<?php

require_once('model/TopicManager.class.php');
require_once('model/CommentManager.class.php');

function listPosts()
{
    $topicManager = new \Damien\Blog\Model\TopicManager(); //On doit mettre le namespace puis le nom de la classe qu'on instancie

    $nbPages = $topicManager->getNbPosts(); //fonction qui compte le nombre de topics de la DB pour une pagination
    $paramFloat = strpos($_GET['page'], "."); //Je vérifie si le paramètre possède une virgule

    if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $nbPages && $paramFloat == false) //Si le paramètre page est valide
    {
        $nbPostPerPage = $topicManager->nbTopicToDisplay($_GET['page']); //fonction qui permet de savoir le nombre de topic à afficher par la page
        $req = $topicManager->getPosts($nbPostPerPage); //fonction qui récupère les topics de la DB
        require('view/listPostsView.php');
    }else{
        header('Location: index.php?action=listPosts&page=1');
    }
}

?>