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



}

?>