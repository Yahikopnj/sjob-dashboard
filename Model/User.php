<?php

namespace App\Model;

use App\Model\DAO;
use \PDOException;

class User
{

    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $cv;
    private $admin;


    public function __construct($firstname, $lastname, $email, $password, $cv, $admin)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_ARGON2ID);
        $this->cv = $cv;
        $this->admin = false;

    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {  

        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCv()
    {
        return $this->cv;
    }

    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }




    public static function findAll()
    {

        try {

            $dao = new DAO();
            $dbh = $dao->getDbh();

            $stmt =  $dbh->query("SELECT * FROM `user`");


            return $stmt->fetchAll();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }

    public static function findById($id_user)
    {
        try {

            $dao = new DAO();
            $dbh = $dao->getDbh();

            $stmt = $dbh->prepare("SELECT * FROM `user` WHERE id_user=?");
            $stmt->bindValue(1, $id_user);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }

    public function insert()
    {
        try {

            $dao = new DAO();
            $dbh = $dao->getDbh();

            $stmt =  $dbh->prepare("INSERT INTO user (lastname, firstname, email, `password`, cv, `admin`)
       VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->lastname);
            $stmt->bindValue(2, $this->firstname);
            $stmt->bindValue(3, $this->email);
            $stmt->bindValue(4, $this->password);
            $stmt->bindValue(5, $this->cv);
            $stmt->bindValue(6, $this->admin);


            $stmt->execute();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }

    public static function deleteid($id_user)
    {
        try {

            $co = new DAO();
            $dbh = $co->getDbh();

            $stmt = $dbh->prepare("DELETE FROM user WHERE id_user=?;");
            $stmt->bindParam(1, $id_user);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }
    public function update($id_user)
    {
        try {

            $co = new DAO();
            $dbh = $co->getDbh();

            $stmt = $dbh->prepare(" UPDATE user SET `lastname`=?, `firstname`=?, 
        `email`=?, `password`=?, `cv`=?, `admin`=false WHERE id_user=?");
            $stmt->bindValue(1, $this->lastname);
            $stmt->bindValue(2, $this->firstname);
            $stmt->bindValue(3, $this->email);
            $stmt->bindValue(4, $this->password);
            $stmt->bindValue(5, $this->cv);
            $stmt->bindValue(6, $id_user);

            return $stmt->execute();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }

    public static function findByEmail($email)
    {
        try {

            $co = new DAO();
            $dbh = $co->getDbh();

            $stmt = $dbh->prepare("SELECT * FROM `user` WHERE `email`=?");

            $stmt->bindValue(1, $email);

            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }

    public function create()
    {
        try {

            $db = new DAO();

            $dbh = $db->getDbh();

            $stmt = $dbh->prepare("INSERT INTO `user` (`lastname`,`firstname`,`email`,`password`,`cv`, `admin`) 
            VALUES (?,?,?,?,?)");

            $stmt->bindValue(1, $this->lastname);
            $stmt->bindValue(2, $this->firstname);
            $stmt->bindValue(3, $this->email);
            $stmt->bindValue(4, $this->password);
            $stmt->bindValue(5, $this->cv);
            $stmt->bindValue(6,false);
            


            return $stmt->execute();
        } catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }
}
