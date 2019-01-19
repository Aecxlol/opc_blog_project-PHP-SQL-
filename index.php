<?php
    session_start();

    require('controller/editCommentFrontend.php');
    require('controller/listPostsCommentsFrontend.php');
    require('controller/listPostsFrontend.php');
    require('controller/loginFrontend.php');
    require('admin/controller/frontend.php');

    try
    {
        if(isset($_GET['action']) && !empty($_GET['action']))
        {
            switch($_GET['action']){

                /***
                    USER PART
                ***/

                case 'listPosts':
                        listPosts();
                        break;

                case 'post':
                        listPostAndComments(); 
                        break;

                case 'addComment':
                        if(isset($_GET['topic']) && !empty($_GET['topic']) && $_GET['topic'] > 0)
                        {
                            if(isset($_POST['author']) AND !empty($_POST['author']) AND isset($_POST['comment']) AND !empty($_POST['comment']))
                            {
                                addComment($_GET['topic'], $_POST['author'], $_POST['comment']);
                            }else{
                                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
                            }
                        }else{
                            throw new Exception('Erreur : topic inexistant !');
                        }
                        break;

                case 'editComment':
                        if(isset($_GET['topic']) && !empty($_GET['topic']) && isset($_GET['commentaire']) && !empty($_GET['commentaire']))
                        {
                            editComment($_GET['commentaire']);
                        }else{
                            throw new Exception('Erreur : Un des champs est vide !');
                        }
                        break;

                case 'commentEdited':
                        if(isset($_POST['commentToEdit']) && !empty($_POST['commentToEdit']) && isset($_GET['idCom']) && !empty($_GET['idCom']))
                        {
                            updateComment($_POST['commentToEdit'], $_GET['idCom']);
                        }else{
                            throw new Exception('Erreur : Un champs est vide !');
                        }
                        break;

                /***
                    LOGIN & SIGN UP PART
                ***/

                case 'login':
                        require('view/loginView.php');
                        break;

                case 'connexion':
                        connexion($_POST['userName'], $_POST['passwd']);
                        break;

                case 'signUpHome':
                        require('view/signUpView.php');
                        break;

                case 'signUp':
                        if(isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['passwd']) && !empty($_POST['passwd']))
                        {
                            if(isset($_POST['confirmPasswd']) && !empty($_POST['confirmPasswd']))
                            {
                                if($_POST['passwd'] == $_POST['confirmPasswd'])
                                {
                                    signUp($_POST['userName'], password_hash($_POST['passwd'], PASSWORD_DEFAULT));
                                }else{
                                    throw new Exception('Vos mots de passe ne correspondent pas !');
                                }
                            }else{
                                throw new Exception('Le champs Confirmer mot de passe est vide !');
                            }
                        }else{
                            throw new Exception('Un des champs est vide !');
                        }
                        break;
                
                /***
                    ADMIN PART
                ***/

                case 'adminMenu':
                        require('admin/view/adminHomeView.php');
                        break;

                case 'adminAddTopic':
                        require('admin/view/addTopicView.php');
                        break;

                case 'addTopic':
                        if(isset($_SESSION['userName']) && !empty($_SESSION['userName']))
                        {
                            if($_SESSION['status'] == 'admin')
                            {
                                if(isset($_POST['topicTitle']) && !empty($_POST['topicTitle']) && isset($_POST['contentTitle']) && !empty($_POST['contentTitle']))
                                {
                                    addTopic($_SESSION['userName'], $_POST['topicTitle'], $_POST['contentTitle']);
                                }else{
                                    throw new Exception('Un des champs est vide !');
                                }  
                            }else{
                                throw new Exception('Accès refusé');
                            }
                        }else{
                            throw new Exception('Vous devez être connecté pour effectuer cette action');
                        }                      
                        break;

                case 'adminEditTopic':
                        displayTopic();
                        break;

                case 'displaySelectedTopic':
                        displaySelectedTopic($_GET['topic']);
                        break;

                case 'editTopic':
                        editTopic($_POST['newTopicTitle'], $_POST['newTopicContent'], $_GET['topic']);
                        break;
                        
                case 'deleteTopic':
                        deleteTopic($_GET['topic']);
                        break;

                /*****************/
                
                case 'disconnect':
                        disconnect();
                        break;

                default:
                        listPosts();
            }
        }else{
            listPosts();
        }
    }catch(Exception $e)
    {
        $errorMessage = $e->getMessage();
        require('view/errorView.php');
    }