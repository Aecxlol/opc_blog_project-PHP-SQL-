<?php
    namespace Damien\Blog\Model;

    require_once('model/Manager.class.php');

    class AdminTopicManager extends Manager
    {
        public function adminAddTopic($userName, $topicTitle, $contentTitle)
        {
            $db = $this->dbconnect();

            $req = $db->prepare('INSERT INTO billets(auteur, titre, contenu, date_creation) VALUES(:auteur, :titre, :contenu, NOW())');
            $req->bindParam('auteur', $userName, \PDO::PARAM_STR);
            $req->bindParam('titre', $topicTitle, \PDO::PARAM_STR);
            $req->bindParam('contenu', $contentTitle, \PDO::PARAM_STR);
            $req->execute();

            return $req;
        }

        public function adminReadTopic($topicId)
        {
            $db = $this->dbconnect();

            $req = $db->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date FROM billets WHERE id= :idTopic');
            $req->bindParam('idTopic', $topicId, \PDO::PARAM_INT);
            $req->execute();
            $topic = $req->fetch();

            return $topic;
        }

        public function adminDeleteTopic($topicId)
        {
            $db = $this->dbconnect();

            $req = $db->prepare('DELETE FROM billets where id=:idTopic');
            $req->bindParam('idTopic', $topicId, \PDO::PARAM_INT);
            $req->execute();

            return $req;
        }

        public function adminUpdateTopic($newTitle, $newContent, $topicId)
        {
            $db = $this->dbconnect();

            $req = $db->prepare('UPDATE billets SET titre = :newTitle, contenu = :newContent WHERE id = :idTopic');
            $req->bindParam('newTitle', $newTitle, \PDO::PARAM_STR);
            $req->bindParam('newContent', $newContent, \PDO::PARAM_STR);
            $req->bindParam('idTopic', $topicId, \PDO::PARAM_INT);
            $req->execute();

            return $req;
        }
    }

?>