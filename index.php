<?php
session_start();
if(!$_SESSION){
    $_SESSION['lang'] = 'fr';
}

if(!isset($_SESSION['user_id'])){
    $_SESSION['username'] = "Guest";
}

define('PATH_DIR', 'http://localhost:8080/WebAvancee/tp3/');
require_once('controller/Controller.php');
require_once('library/RequirePage.php');
require_once __DIR__.'/vendor/autoload.php';
require_once('library/Twig.php');
require_once('library/CheckSession.php');


//Prépare le log pour le journal de bord
$log["page"] = $_SERVER['REQUEST_URI'];
$log["date"] = date("Y/m/d H:i:s");
$log["adresse_ip"] = $_SERVER['SERVER_ADDR'];
$log["nom_utilisateur"] = $_SESSION['username'];

RequirePage::model('JournalDeBord');

$logEntry = new JournalDeBord;

$insert = $logEntry->insertLogEntry($log);

$url = isset($_GET['url'])? explode('/', ltrim($_GET['url'], '/')) : '/';

//Si il n'y a pas de controller, method ou value, va à home
if($url == '/'){
    require_once('controller/ControllerHome.php');
    $controller = new ControllerHome;
    echo $controller->index(); 
}else{
    //controller
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";

    if(file_exists($controllerPath)){
        require_once( $controllerPath);
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;
        if(isset($url[1])){
            $method = $url[1];

            if(method_exists($controller, $method)){
                if(isset($url[2])){
                    echo $controller->$method($url[2]);
                }else{
                    echo $controller->$method();
                }
            } else {
                RequirePage::url('home/error/404');
            }
        }else{
            echo $controller->index();
        }
    }else{
        require_once('controller/ControllerHome.php');
        $controller = new ControllerHome;
        echo $controller->error('404'); 
    }
}