<?php

    require_once('admin/model/AdminTopicManager.class.php');
    require_once('./model/TopicManager.class.php');

    function addTopic($userName, $topicTitle, $contentTitle)
    {
        $adminTopicManager = new \Damien\Blog\Model\AdminTopicManager();

        $req = $adminTopicManager->adminAddTopic($userName, $topicTitle, $contentTitle);

        require('admin/view/addTopicSuccessView.php');
    }

    function displaySelectedTopic($topicId)
    {
        $adminTopicManager = new \Damien\Blog\Model\AdminTopicManager();

        $topic = $adminTopicManager->adminReadTopic($topicId);

        require('admin/view/editTopicView.php');
    }

    function editTopic($newTitle, $newContent, $topicId)
    {
        $adminTopicManager = new \Damien\Blog\Model\AdminTopicManager();

        $req = $adminTopicManager->adminUpdateTopic($newTitle, $newContent, $topicId);

        require('admin/view/topicEditedSuccessView.php');
    }

    function displayTopic()
    {
        $topicManager = new \Damien\Blog\Model\TopicManager();

        $nbPages = $topicManager->getNbPosts(); //fonction qui compte le nombre de topics de la DB pour une pagination
        $nbPostPerPage = $topicManager->nbTopicToDisplay($_GET['page']);
        $req = $topicManager->getPosts($nbPostPerPage); //fonction qui récupère les topics de la DB

        require('admin/view/deleteTopicView.php');
    }

    function deleteTopic($idTopic)
    {
        $adminTopicManager = new \Damien\Blog\Model\AdminTopicManager();

        $adminTopicManager->adminDeleteTopic($idTopic);

        require('admin/view/topicDeletedSuccessView.php');
    }

?>