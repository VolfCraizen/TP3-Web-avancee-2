<?php
RequirePage::model('CRUD');
RequirePage::model('Usager');
RequirePage::library('Validation');


class ControllerLogin extends Controller {

    public function index(){
        Twig::render('auth/authentification-index.php');
    }

    public function auth(){

        $validation = new Validation;
        extract($_POST);
        $validation->name('username')->value($username)->max(50)->required();
        $validation->name('password')->value($password)->max(20)->required();

        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('auth/authentification-index.php', ['errors' => $errors, 'usagers' => $_POST]);
            exit();
        }

        $user = new Usager;
        $checkUser = $user->checkUser($_POST['username'], $_POST['password']);

        Twig::render('auth/authentification-index.php', ['errors'=>$checkUser, 'usagers' => $_POST]);
    }

    public function logout(){
        session_destroy();
        RequirePage::url('login');
    }
}
?>