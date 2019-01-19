<?php

require_once('model/TopicManager.class.php');
require_once('model/CommentManager.class.php');
require_once('model/LoginManager.class.php');

function connexion($userName, $passwd)
{
    $loginManager = new \Damien\Blog\Model\LoginManager();

    if(isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['passwd']) && !empty($_POST['passwd']))
    {
        $hashedPassword = $loginManager->getHashedPassword($userName);
             
        if(password_verify(($_POST['passwd']), $hashedPassword['password']))//Je vérifie que le pass rentré par l'utilisateur correspond au mot de passe hashé
        {
            $reqLogIn = $loginManager->fLogin($userName, $hashedPassword['password']);//Si la fonction me retourne true alors je lance ma connexion
        }else{
            $reqLogIn = false;
        }


        if($reqLogIn != false)
        {
            session_start();
            $_SESSION['userName'] = $_POST['userName']; //je stocke le pseudo de l'admin dans une variable de session
            $_SESSION['status'] = $reqLogIn['status'];
    
            if($_SESSION['status'] == 'admin')
            {
                header('Location: index.php?action=adminMenu');//et je redirige vers le menu administrateur
            }else{
                header('Location: index.php');
            }
            
        }else{
            throw new Exception('Pseudo ou mot de passe incorrect');
        }
    }else{
        throw new Exception('Un des champs est vide');
    }
}

function signUp($userName, $passwd)
{
    $loginManager = new \Damien\Blog\Model\LoginManager();

    if($loginManager->getUserName($userName) == false)//Si le pseudo n'existe pas dans la base
    {
        $req = $loginManager->fSignUp($userName, $passwd);

        require('view/signUpSuccessView.php');
    }else{
        throw new Exception('Ce nom d\'utilisateur est déjà pris');
    }    
}

function disconnect()
{
    session_destroy();

    require('view/disconnectSuccess.php');
}

?>