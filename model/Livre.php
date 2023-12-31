<?php

class Livre extends CRUD {

    protected $table = 'livre';
    protected $primaryKey = 'id';
    
    /**
     * Calcule le prix du livre avec rabais et retourne le total
     */
    function calculeRabais($prix, $rabais){
        $prixFinal = $prix - ($prix * $rabais/100);

        return $prixFinal;
    }

    /**
     * Vérifie si il y a un livre lié à l'auteur ou éditeur
     */
    function checkForeignKey($id, $foreignTable){
        $sql = "SELECT * FROM $this->table WHERE $foreignTable = $id";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count >= 1){
            $errors = "Erreur : Cette auteur/éditeur a un ou des livres assossiés avec. Veuillez sois les éffacer avant ou les mettre à un autre auteur/éditeur.";
            return $errors;
        }else{
            return "valid";
        }

    }
}

?>
