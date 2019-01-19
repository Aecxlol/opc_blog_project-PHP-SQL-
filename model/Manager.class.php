<?php

namespace Damien\Blog\Model; //Je place la classe manager dans le namespace

class Manager
{
    protected function dbConnect() //protected est comme private sauf qu'il permet au moins d'être visible par les classes qui héritent de cette fonction
    {
        
        $db = new \PDO('mysql:host=localhost;dbname=tp_blog;charset=utf8', 'root', '');

        return $db;
    }

    public function nbTopicToDisplay($currentPage)
    {
        $nbPostPerPage = ($currentPage*5)-5;//cette variable va nous servir pour savoir la LIMIT de la requête sql des topics à afficher

        return $nbPostPerPage;
    }
}
?>