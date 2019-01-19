<?php

namespace Damien\Blog\Model; //Le namespace va permettre d'appeller une classe plusieurs fois sans faire d'erreur. Il agit comme un chemin de dossier

require_once('model/Manager.class.php');

class TopicManager extends Manager
{
    public function getNbPosts()
    {
        $db = $this->dbConnect();

        /* REQUETE POUR CALCULER LE NOMBRE D'ENTREE DE MA TABLE POUR CALCULER LE NOMBRE DE PAGE */
        $nbEntries = $db->prepare('SELECT COUNT(*) AS nbTopic FROM billets');//Calcul du nombre de topics pour faire ma pagination
        $nbEntries->execute();
        $nbEntries=$nbEntries->fetch();//fetch nous retourne un tableau
        $nbPages = ceil($nbEntries['nbTopic']/5);//Calcul du nombre de page avec ceil qui arrondit au nombre supérieur car si on a 1.2 il faudra 2 pages. On veut 5 topics par page

        return $nbPages;
    }

    public function getPosts($nbPostPerPage)
    {
        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date FROM billets ORDER BY date_creation DESC LIMIT :nbPostPerPage, 5'); //Récupération des topics dans l'odre décroissant
        //par date et de la date avec la fonction DATE_FORMAT
        $req->bindParam('nbPostPerPage', $nbPostPerPage, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();

        /* RECUPERATION DU TOPIC */
        $reqPost = $db->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date FROM billets WHERE id= :postId'); //Récupération des messages en fonction de la page
        $reqPost->bindParam('postId', $postId, \PDO::PARAM_INT);
        $reqPost->execute(); //On utilise le prepare / execute quand il y a une variable dans la requête pour les failles d'injections sql
        $topic = $reqPost->fetch(); //pas besoin de boule while comme il y en a qu'un

        return $topic;
    }
}
?>