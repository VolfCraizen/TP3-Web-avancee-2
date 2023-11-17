<?php
RequirePage::model('CRUD');
class JournalDeBord extends CRUD {

    protected $table = 'journaldebord';
    protected $primaryKey = 'id';

    protected $fillable = ['page', 'date', 'adresse_ip', 'nom_utilisateur'];


    function insertLogEntry($data){

        $nomChamp = implode(", ",array_keys($data));
        $valeurChamp = ":".implode(", :", array_keys($data));

        $sql = "INSERT INTO $this->table ($nomChamp) VALUES ($valeurChamp)";
        $stmt = $this->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();

        return $this->lastInsertId();

    }

}

?>