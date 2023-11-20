<?php

class Usager extends CRUD {

    protected $table = 'usager';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'Privilege_id'];

    /**
     * Vérification de l'existence de l'utilisateur et vérification du mot de passe
     */
    public function checkUser($username, $password){
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));
        $count = $stmt->rowCount();

        if($count === 1){
            $salt = "g3k6jhg546hg36g3";
            $saltPassword = $password.$salt;
            $info_user = $stmt->fetch();
    
            if (password_verify($saltPassword, $info_user['password'])) {
                session_regenerate_id();
                $_SESSION['user_id'] = $info_user['id'];
                $_SESSION['username'] = $info_user['username'];
                $_SESSION['privilege'] = $info_user['Privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
    
                RequirePage::url('home');
                exit();
            }else{
                $errors = "<ul><li> Vérifier si le mot de passe est bien écrit</li></ul>";
                return $errors;
            }
    
    
        }else{
            $errors = "<ul><li> Vérifier si le nom d'utilisateur est bien écrit</li></ul>";
            return $errors;
        }
    }

    /**
     * Vérification si le nom d'utilisateur est déjà pris
     */
    public function checkUsername($username){
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));
        $count = $stmt->rowCount();

        if($count === 1){
            $errors = "<ul><li> Nom d'utilisateur déjà pris. Veuillez en choisir un autre. </li></ul>";
            return $errors;
        }else{
            return "valid";
        }
    }
    
}

?>