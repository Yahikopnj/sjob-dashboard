<?php
namespace App\Controller;
use App\Model\User;
require("../autoloader.php");
class UserController{

/**c'est la function qui sert a rappeler le param dans le router */
public static function all(){
    $users = User::findAll();
    require("../View/Admin/ReadAllUser.php");
}

public static function readById($id_user){
    $user = User::findById($id_user);
    require("../View/ReadUser.php");
}

public  static function create($post){
    $user=  new User($post["lastname"], $post["firstname"], $post["email"], $post["password"], $post["cv"], false);
    $user->insert();
    self::all();
 }
 public static function delete($id_user){
    $user = user::deleteid($id_user);
    self::all();

 }

 public static function insert($post){
    $user = new User($post["lastname"],$post["firstname"],$post["email"],$post["password"],$post["cv"], false);
    $user->create();
    self::all();

 }

 public static function formUpdate($id_user){
    
    $user= User::findById($id_user);
   
    require("../View/Admin/formUpdateUser.php");
}


public static function update($post){

   $user = new User($post["lastname"],$post["firstname"],$post["email"],$post["password"],$post["cv"], false);

   $user->update($post["id_user"]);

   self::all();
}


public static function regist($post){
    $erreurs = [];
    $cv = null;
    $lastname = null;
    $firstname = null;

    if(empty($post["email"]) || empty($post["password"])){
        $erreurs +=["manquant"=>"veuillez remplir les chapms vide"];
    }

    if(!empty($post["lastname"])){
        $lastname = strip_tags($post["lastname"]);
    }


    if(!empty($post["firstname"])){
        $firstname = strip_tags($post["firstname"]);
    }

    if(!empty($post["cv"])){
        $cv = "../static/image";
        if(file_exists($cv["cv"])){
            echo "le fichier $cv existe";
        }else{
            echo "le fichier $cv existe pas";
        }
    }

    // $password = password_hash($post["password"], PASSWORD_ARGON2ID);

    $email = filter_var($post["email"], FILTER_VALIDATE_EMAIL);


    if($email == false){
        $erreurs += ["emaila"=>"format email invalide"];
    }

    $search = User::findByEmail($email);

        if($search != false){
         $erreurs +=["emailb"=>"cet email est déjà existant"];
        }
    if(empty($erreurs)){
        $user = new User($firstname, $lastname, $post["email"], $post["password"], $cv, $post["admin"]);
        $user->create();
        header("location : ../View/Public/login.php");
    }else{
        require("../View/Public/register.php");
    }
}

public static function login($post){
    $erreurs = [];

    if(empty($post["email"]) || empty($post["password"])){
        $erreurs +=["manquant"=>"completez le formulaire correctement"];

    }

    $email = filter_var($post["email"], FILTER_VALIDATE_EMAIL);

    if($email == false){
        $erreurs +=["emaila"=>"email invalide"];
    }

    $user = User::findById($email);

    if($user == false){
        $erreurs +=["emailb"=>"ce compte n'existe pas"];
    }

    if(password_verify($post["password"], $user["password"]) == 0){
        session_start();

        $_SESSION["lastname"] = $user["lastname"];
        $_SESSION["admin"] = $user["admin"];

        require("../View/Public/profil.php");
    }
}

public static function findById($id_user){

  $user= User::findById($id_user);
  
  require("../View/Admin/ReadUser.php");

}

}

?>