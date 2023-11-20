<?php

class Twig{
    static public function render($template, $data = array()){
        $loader = new \Twig\Loader\FilesystemLoader('view');
        $twig = new \Twig\Environment($loader, array('auto_reload' => true));

        if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] === md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])){
            $guest = false;
        }else{
            $guest = true;
        }

        //Gestion de langue
        if ($_SESSION['lang'] == 'en') {
            include('language/EN.php');
        } else if ($_SESSION['lang'] == 'fr'){
            include('language/FR.php');
        }    

        $twig->addGlobal('path', PATH_DIR);
        $twig->addGlobal('lang',  $lang);
        $twig->addGlobal('guest', $guest);
        $twig->addGlobal('session', $_SESSION);
        echo $twig->render($template, $data);
    }
}
?>