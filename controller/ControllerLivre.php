<?php

RequirePage::model('CRUD');
RequirePage::model('Livre');
RequirePage::model('Auteur');
RequirePage::model('Editeur');
RequirePage::library('Validation');

class ControllerLivre extends controller {
    public function index(){

        $livre = new Livre;
        $auteur = new Auteur;
        $editeur = new Editeur;
        $select = $livre->select();

        /**
         * Transforme les tables du tableau multidimensionnel en pseudo tableaux unidimensionnels pour ajouter des champs 
         */
        $i = 0;
        foreach($select as $selected){
            $select[$i]['prixRabais'] = $prixRabais = $livre->calculeRabais($selected['prix'], $selected['rabais']);
            //Ajoute les tables auteur et editeur à livre à des champs additionels
            $select[$i]['livreAuteur'] = $auteur->selectId($selected['Auteur_id']);
            $select[$i]['livreEditeur'] = $editeur->selectId($selected['Editeur_id']);
            $i++;
        }

        return Twig::render('livre/livre-index.php', ['livres'=>$select]);

    }

    public function create(){
        if ($_SESSION['privilege'] == 1 || $_SESSION['privilege'] == 2) {
            $auteur = new Auteur;
            $selectAuteurs = $auteur->select('nom');
            $editeur = new Editeur;
            $selectEditeurs = $editeur->select('nom');
            return Twig::render('livre/livre-create.php', ['auteurs'=>$selectAuteurs, 'editeurs'=>$selectEditeurs]);
        } else {
            RequirePage::url('login');
        }
    }

    public function store(){

        //Verifie principalement si un refraichissement de page (En utilisent le url) à été éffectué et retourne à create si oui pour éviter une erreur php
        if($_POST == null){
            RequirePage::url('livre/create');
        }

        $validation = new Validation;
        $auteur = new Auteur;
        $selectAuteurs = $auteur->select('nom');
        $editeur = new Editeur;
        $selectEditeurs = $editeur->select('nom');
        extract($_POST);
        $validation->name('titre')->value($titre)->max(50)->min(2)->required();
        $validation->name('date_de_publication')->value($date_de_publication)->pattern('date_ymd')->required();
        $validation->name('prix')->value($prix)->required();
        $validation->name('rabais')->value($rabais)->required();
        $validation->name('auteur')->value($auteur_id)->required();
        $validation->name('editeur')->value($editeur_id)->required();

        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('livre/livre-create.php', ['auteurs'=>$selectAuteurs, 'editeurs'=>$selectEditeurs, 'errors'=>$errors, 'livres' => $_POST, 'id_auteur' => $_POST["auteur_id"], 'id_editeur' => $_POST["editeur_id"]]);
            exit();
        }

        $livre = new Livre;
        $insert = $livre->insert($_POST);

        RequirePage::url('livre');
    }


    public function show($id = null){
        
        if (isset($id) && $id != null) {
            $livre = new Livre;
            $auteur = new Auteur;
            $editeur = new Editeur;
            $selectId = $livre->selectId($id);
            $selectAuteurs = $auteur->selectId($selectId['Auteur_id']);
            $selectEditeurs = $editeur->selectId($selectId['Editeur_id']);
            $selectId['prixRabais'] = $prixRabais = $livre->calculeRabais($selectId['prix'], $selectId['rabais']);
            return Twig::render('livre/livre-show.php', ['livres'=>$selectId, 'auteurs'=>$selectAuteurs, 'editeurs'=>$selectEditeurs]);    
        } else {
            RequirePage::url('home/error/404');
        }
    }

    public function edit($id = null){
        if (isset($id) && $id != null) {
            if ($_SESSION['privilege'] == 1) {
                $livre = new Livre;
                $selectId = $livre->selectId($id);
                $auteur = new Auteur;
                $selectAuteurs = $auteur->select('nom');
                $editeur = new Editeur;
                $selectEditeurs = $editeur->select('nom');
                return Twig::render('livre/livre-edit.php', ['livres'=>$selectId, 'auteurs'=>$selectAuteurs, 'editeurs'=>$selectEditeurs]);
            } else {
                RequirePage::url('login');
            }
        } else {
            RequirePage::url('home/error/404');
        }
        
    }

    public function update(){
        //Verifie principalement si un refraichissement de page (En utilisent le url) à été éffectué et retourne à l'index si oui pour éviter une erreur php
        if($_POST == null){
            RequirePage::url('livre');
        }
        $validation = new Validation;
        $auteur = new Auteur;
        $selectAuteurs = $auteur->select('nom');
        $editeur = new Editeur;
        $selectEditeurs = $editeur->select('nom');
        extract($_POST);
        $validation->name('titre')->value($titre)->max(50)->required();
        $validation->name('date_de_publication')->value($date_de_publication)->pattern('date_ymd')->required();
        $validation->name('prix')->value($prix)->required();
        $validation->name('rabais')->value($rabais)->required();
        $validation->name('auteur')->value($Auteur_id)->required();
        $validation->name('editeur')->value($Editeur_id)->required();

        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('livre/livre-edit.php', ['auteurs'=>$selectAuteurs, 'editeurs'=>$selectEditeurs, 'errors'=>$errors, 'livres' => $_POST]);
            exit();
        }
        
        $livre = new Livre;
        $update = $livre->update($_POST);
        RequirePage::url('livre');
    }

    public function destroy(){
        if ($_SESSION['privilege'] == 1) {
            $livre = new Livre;
            $destroy = $livre->delete($_POST["id"]);
            RequirePage::url('livre');
        } else {
            RequirePage::url('login');
        }
    }
}

?>