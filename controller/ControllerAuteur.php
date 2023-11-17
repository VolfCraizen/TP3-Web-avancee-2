<?php

RequirePage::model('CRUD');
RequirePage::model('Auteur');
RequirePage::model('Livre');
RequirePage::library('Validation');

class ControllerAuteur extends Controller {

    public function index(){
        $auteur = new Auteur;
        $select = $auteur->select();
        return Twig::render('auteur/auteur-index.php', ['auteurs'=>$select]);

    }

    public function create(){
        if ($_SESSION['privilege'] == 1 || $_SESSION['privilege'] == 2) {
            return Twig::render('auteur/auteur-create.php');
        } else {
            RequirePage::url('login');
        }
    }

    public function store(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('nom')->value($nom)->max(50)->required();
        $validation->name('date_de_naissance')->value($date_de_naissance)->pattern('date_ymd')->required();

        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('auteur/auteur-create.php', ['errors'=>$errors, 'auteurs' => $_POST]);
            exit();
        }

        $auteur = new Auteur;
        $insert = $auteur->insert($_POST);
        RequirePage::url('auteur/show/'.$insert);

        RequirePage::url('auteur');
    }

    public function show($id = null){

        if (isset($id) && $id != null) {
            $auteur = new Auteur;
            $selectId = $auteur->selectId($id);
            $livre = new Livre;
            $selectLivres = $livre->select('titre');
            return Twig::render('auteur/auteur-show.php', ['auteurs'=>$selectId, 'livres'=>$selectLivres]);
        } else {
            RequirePage::url('home/error/404');
        }
    }

    public function edit($id = null){

        if (isset($id) && $id != null) {
            if ($_SESSION['privilege'] == 1) {
                $auteur = new Auteur;
                $selectId = $auteur->selectId($id);
                return Twig::render('auteur/auteur-edit.php', ['auteurs'=>$selectId]);
            } else {
                RequirePage::url('login');
            }
        } else {
            RequirePage::url('home/error/404');
        }
    }

    public function update(){

        $validation = new Validation;
        extract($_POST);
        $validation->name('nom')->value($nom)->max(50)->min(2);
        $validation->name('date_de_naissance')->value($date_de_naissance)->pattern('date_ymd')->required();



        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('auteur/auteur-edit.php', ['errors'=>$errors, 'auteurs'=>$_POST]);
            exit();
        }
        $auteur = new Auteur;
        $update = $auteur->update($_POST);
        RequirePage::url('auteur');
    }

    public function destroy(){
        if ($_SESSION['privilege'] == 1) {
            $auteur = new Auteur;
            $destroy = $auteur->delete($_POST["id"]);
            RequirePage::url('auteur');
        } else {
            RequirePage::url('login');
        }
    }
}