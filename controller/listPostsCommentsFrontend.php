<?php

require_once('model/TopicManager.class.php');
require_once('model/CommentManager.class.php');

function listPostAndComments()
{
    $topicManager = new \Damien\Blog\Model\TopicManager();
    $commentManager = new \Damien\Blog\Model\CommentManager();

    $arrayNbPagesComments = $commentManager->getNbComments($_GET['topic']);
    $paramFloat = strpos($_GET['page'], "."); //Je vérifie si le paramètre possède une virgule
    $topic = $topicManager->getPost($_GET['topic']);

    if($arrayNbPagesComments[1] == 0)
    {
        $arrayNbPagesComments[1] = 1;
        $test = 0;
    }else{
        $test = 1;
    }

    if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $arrayNbPagesComments[1] && $paramFloat == false)
    {
        if(isset($topic) && !empty($topic)) //$topic existe si l'id que rentre l'user dans l'url est correcte
        {
            $nbPostPerPage = $topicManager->nbTopicToDisplay($_GET['page']);
            $reqComments = $commentManager->getComments($_GET['topic'], $nbPostPerPage);
            require('view/listPostAndCommentsView.php');
        }else{
            throw new Exception('Le post que vous recherchez n\'existe pas');
        }
        
    }else{
        header('Location: index.php?action=post&topic='.$_GET['topic'].'&page=1');
    }
}
?>