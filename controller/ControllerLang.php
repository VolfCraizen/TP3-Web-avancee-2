<?php

class ControllerLang extends Controller {
    public function index(){
        
    }

    public function change($id){
        $_SESSION['lang'] = $id;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}