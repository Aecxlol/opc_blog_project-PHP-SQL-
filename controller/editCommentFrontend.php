<?php

require_once('model/TopicManager.class.php');
require_once('model/CommentManager.class.php');

function addComment($postId, $author, $comment)
{
    $commentManager = new \Damien\Blog\Model\CommentManager();

    $reqWritingCom = $commentManager->postComment($postId, $author, $comment);

    if($reqWritingCom === false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire');
    }else{
        header('Location: index.php?action=post&topic='.$postId.'&page=1');//Je redirige ensuite vers la page du topic
    }
}

function editComment($idCom)
{
    $commentManager = new \Damien\Blog\Model\CommentManager();

    $reqGetOneCom = $commentManager->getOneComment($idCom);

    require('view/editCommentsView.php');
}

function updateComment($newCom, $idCom)
{
    $commentManager = new \Damien\Blog\Model\CommentManager();

    $reqUpdateCom = $commentManager->updateCom($newCom, $idCom);

    require('view/editedCommentsView.php');
}
?>