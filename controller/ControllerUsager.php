<?php

RequirePage::model('CRUD');
RequirePage::model('Usager');
RequirePage::model('Privilege');
RequirePage::library('Validation');

class ControllerUsager extends controller {

    public function __construct(){
        CheckSession::sessionAuth();
        //Kick out if they make it with url
        if ($_SESSION['privilege'] == 1 || $_SESSION['privilege'] == 2) {
            
        } else {
            RequirePage::url('login');
            exit();
        }

       
    }
    
    public function index(){

        $usager = new Usager;
        $select = $usager-> select("username");

        $privilege = new Privilege;

        $i = 0;
        foreach($select as $usager){
            $selectId = $privilege->selectId($usager['Privilege_id']);
            $select[$i]['Privilege_id'] = $selectId['nom'];
            $i++;
        }

        return Twig::render('usager/usager-index.php', ['usagers'=>$select]);

    }

    public function create(){
        if ($_SESSION['privilege'] == 1) {
            $privilege = new Privilege;
            $selectPrivileges = $privilege->select('nom');
            return Twig::render('usager/usager-create.php', ['privileges'=>$selectPrivileges]);
        } else {
            RequirePage::url('login');
        }
    }

    public function store(){
        //Verifie principalement si un refraichissement de page (En utilisent le url) à été éffectué et retourne à create si oui pour éviter une erreur php
        if($_POST == null){
            RequirePage::url('usager/create');
        }
        $validation = new Validation;
        extract($_POST);
        $validation->name('username')->value($username)->max(50)->required();
        $validation->name('password')->value($password)->max(20)->min(4)->required();
        $validation->name('privilege')->value($Privilege_id)->required();

       if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            $privilege = new Privilege;
            $selectPrivileges = $privilege->select('nom');
            return Twig::render('usager/usager-create.php', ['errors' => $errors, 'privileges' => $selectPrivileges, 'usagers' => $_POST, 'id_privilege' => $_POST["Privilege_id"]]);
            exit();
        }

        $usager = new Usager;

        $checkUsername = $usager->checkUsername($_POST['username']);

        //Vérification si nom d'utilisateur est un doublon avant l'insertion dans la base de données 
        if($checkUsername == "valid"){
            $_POST['password'];

            $option = [
                'cost' => 10
            ];

            $salt = "g3k6jhg546hg36g3";
            $passwordSalt = $_POST['password'].$salt;
            $_POST['password'] = password_hash($passwordSalt, PASSWORD_BCRYPT, $option);
            $insert = $usager->insert($_POST);
            RequirePage::url('usager');

        } else {
            $errors = $checkUsername;
            $privilege = new Privilege;
            $selectPrivileges = $privilege->select('nom');
            return Twig::render('usager/usager-create.php', ['errors' => $errors, 'privileges' => $selectPrivileges, 'usagers' => $_POST, 'id_privilege' => $_POST["Privilege_id"]]);
        }

        
    }

    public function destroy(){
        if ($_SESSION['privilege'] == 1) {
            $usager = new Usager;
            $destroy = $usager->delete($_POST["id"]);
            RequirePage::url('usager');
        }else{
            RequirePage::url('login');
        }
    }
}

?>