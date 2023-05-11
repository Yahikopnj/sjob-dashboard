<?php


use App\controller\UserController;
require_once("../autoloader.php");

if($_GET["action"]){

    if($_GET["action"] == "all"){
        
        UserController::All();
        
    }elseif($_GET["action"] == "create"){
        
        UserController::insert($_POST);
        
    }elseif($_GET["action"] == "read"){
    
        UserController::findById($_GET["id_user"]);

    }elseif($_GET["action"] == "delete"){
       
        UserController::delete($_GET["id_user"]);

    }elseif($_GET["action"] == "formUpdate"){
    
        UserController::formUpdate($_GET["id_user"]);

    }elseif($_GET["action"] == "update"){
    
        UserController::update($_POST);

    }elseif($_GET["action"] == "register"){
    
        UserController::regist($_POST);

    }elseif($_GET["action"] == "login"){
    
        UserController::login($_POST);
    }
}