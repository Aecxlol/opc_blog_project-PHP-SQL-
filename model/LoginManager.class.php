<?php
namespace Damien\Blog\Model;

class LoginManager extends Manager
{
    public function fLogin($userName, $passwd)
    {
        $db = $this->dbconnect();

        $req = $db->prepare('SELECT * FROM user WHERE userName=:userName AND password=:passwd');
        $req->bindParam('userName', $userName, \PDO::PARAM_STR);
        $req->bindParam('passwd', $passwd, \PDO::PARAM_STR);
        $req->execute();
        $reqLogIn = $req->fetch();

        return $reqLogIn;
    }

    public function fSignUp($userName, $passwd)
    {
        $db = $this->dbconnect();

        $req = $db->prepare('INSERT INTO user(userName, password, status) VALUES(:userName, :password, "standard")');
        $req->bindParam('userName', $userName, \PDO::PARAM_STR);
        $req->bindParam('password', $passwd, \PDO::PARAM_STR);
        $req->execute();

        return $req;
    }

    public function getHashedPassword($userName)
    {
        $db = $this->dbconnect();

        $req = $db->prepare('SELECT * FROM user WHERE userName=:userName');
        $req->bindParam('userName', $userName, \PDO::PARAM_STR);
        $req->execute();
        $hashedPassword = $req->fetch();

        return $hashedPassword;
    }

    public function getUserName($userName)
    {
        $db = $this->dbconnect();

        $req = $db->prepare('SELECT * FROM user WHERE userName=:userName');
        $req->bindParam('userName', $userName, \PDO::PARAM_STR);
        $req->execute();
        $userNameTable = $req->fetch();

        return $userNameTable;
    }
}
?>