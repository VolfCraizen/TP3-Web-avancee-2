<?php

RequirePage::model('CRUD');
RequirePage::model('Editeur');
RequirePage::model('Livre');
RequirePage::library('Validation');

class ControllerEditeur extends Controller {
    public function index(){

        $editeur = new Editeur;
        $select = $editeur->select();
        return Twig::render('editeur/editeur-index.php', ['editeurs'=>$select]);

    }

    public function create(){
        if ($_SESSION['privilege'] == 1 || $_SESSION['privilege'] == 2) {
            return Twig::render('editeur/editeur-create.php');
        } else {
            RequirePage::url('login');
        }
    }

    public function store(){

        $validation = new Validation;
        extract($_POST);
        $validation->name('nom')->value($nom)->max(50)->min(2)->required();
        $validation->name('adresse')->value($adresse)->max(50)->min(10)->required();
        $validation->name('telephone')->value($telephone)->max(15)->min(10)->pattern('tel')->required();
        $validation->name('courriel')->value($courriel)->max(50)->min(10)->pattern('email')->required();

        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('editeur/editeur-create.php', ['errors'=>$errors, 'editeurs' => $_POST]);
            exit();
        }

        $editeur = new Editeur;
        $insert = $editeur->insert($_POST);
        RequirePage::url('editeur/show/'.$insert);

        RequirePage::url('editeur');
    }


    public function show($id = null){
        if (isset($id) && $id != null) {
            $editeur = new Editeur;
            $selectId = $editeur->selectId($id);
            $livre = new Livre;
            $selectLivres = $livre->select('titre');
            return Twig::render('editeur/editeur-show.php', ['editeurs'=>$selectId, 'livres'=>$selectLivres]);
        } else {
            RequirePage::url('home/error/404');
        }
    }

    public function edit($id = null){

        if (isset($id) && $id != null) {
            if ($_SESSION['privilege'] == 1) {
                $editeur = new Editeur;
                $selectId = $editeur->selectId($id);
                return Twig::render('editeur/editeur-edit.php', ['editeurs'=>$selectId]);
            } else {
                RequirePage::url('login');
            }
        } else {
            RequirePage::url('home/error/404');;
        }


    }

    public function update(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('nom')->value($nom)->max(50)->required();
        $validation->name('adresse')->value($adresse)->max(50)->min(5)->required();
        $validation->name('telephone')->value($telephone)->max(15)->min(10)->pattern('tel')->required();
        $validation->name('courriel')->value($courriel)->max(50)->min(10)->pattern('email')->required();

        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('editeur/editeur-edit.php', ['errors'=>$errors, 'editeurs' => $_POST]);
            exit();
        }
        $editeur = new Editeur;
        $update = $editeur->update($_POST);
        RequirePage::url('editeur');
    }

    public function destroy(){
        if ($_SESSION['privilege'] == 1) {
            $editeur = new Editeur;
            $destroy = $editeur->delete($_POST["id"]);
            RequirePage::url('editeur');
        } else {
            RequirePage::url('login');
        }
    }
}