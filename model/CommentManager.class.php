<?php

namespace Damien\Blog\Model;

require_once('model/Manager.class.php');

class CommentManager extends Manager
{
    public function getNbComments($postId)
    {
        $db = $this->dbConnect();

        $arrayNbPagesComments = []; //Ce tableau va servir à l'affichage du nombre de page si il existe des commentaires

        /* CALCUL DU NOMBRE DE COMMENTAIRES */
        $nbEntrees = $db->prepare('SELECT COUNT(*) AS nbCommentaires FROM commentaires WHERE id_billets=:postId');//en prenant en compte le numéro du topic
        $nbEntrees->bindParam('postId', $postId, \PDO::PARAM_INT);
        $nbEntrees->execute();
        $nbEntrees = $nbEntrees->fetch();
        $nbPagesComments = ceil($nbEntrees['nbCommentaires']/5);//calcul du nombre de page ; 5 commentaires par page. Ceil arrondi à l'entier supérieur

        array_push($arrayNbPagesComments, $nbEntrees, $nbPagesComments);
        
        return $arrayNbPagesComments;
    }

    public function getComments($postId, $nbPostPerPage) //$nbPostPerPage est en fait le nombre de commentaire par page mais pour pas faire 2 fois la même fonction j'use la même
    {
        $db = $this->dbConnect();

        /* RECUPERATION DES COMMENTAIRES */
        $reqComments = $db->prepare('SELECT id,id_billets,auteur,commentaire, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS dateCom FROM commentaires WHERE id_billets=:idBillets ORDER BY date_commentaire DESC LIMIT :nbPostPerPage,5'); //Récupération des messages en fonction de la page
        $reqComments->bindParam('idBillets', $postId, \PDO::PARAM_INT);//Je donne les paramètre à bind param (les marqueurs dans mon prepare)
        $reqComments->bindParam('nbPostPerPage', $nbPostPerPage, \PDO::PARAM_INT);//et je précise le type de variable avec PDO::PARAM_INT que c'est un int
        $reqComments->execute();

        return $reqComments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();

        $reqWritingCom = $db->prepare('INSERT INTO commentaires(id_billets, auteur, commentaire, date_commentaire) VALUES(:id_billets, :auteur, :commentaire, NOW())');//NOW() permet d'écrire la date et l'heure actuelle
        $reqWritingCom->bindParam('id_billets', $postId, \PDO::PARAM_INT);
        $reqWritingCom->bindParam('auteur', $author, \PDO::PARAM_STR);
        $reqWritingCom->bindParam('commentaire', $comment, \PDO::PARAM_STR);
        $reqWritingCom->execute();

        return $reqWritingCom;
    }

    public function getOneComment($idCom)
    {
        $db = $this->dbconnect();

        $reqGetOneCom = $db->prepare('SELECT id,id_billets,auteur,commentaire, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS dateCom FROM commentaires WHERE id=:idCom');
        $reqGetOneCom->bindParam('idCom', $idCom, \PDO::PARAM_INT);
        $reqGetOneCom->execute();

        return $reqGetOneCom;
    }

    public function updateCom($newCom, $idCom)
    {
        $db = $this->dbconnect();

        $reqUpdateCom = $db->prepare('UPDATE commentaires SET commentaire=:newCom WHERE id=:idCom');
        $reqUpdateCom->bindParam('newCom', $newCom, \PDO::PARAM_STR);
        $reqUpdateCom->bindParam('idCom', $idCom, \PDO::PARAM_INT);
        $reqUpdateCom->execute();

        return $reqUpdateCom;
    }
}
?>