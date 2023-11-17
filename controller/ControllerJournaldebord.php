<?php

RequirePage::model('CRUD');
RequirePage::model('JournalDeBord');

class ControllerJournaldebord extends controller {
    public function index(){

        $logs = new JournalDeBord;
        $select = $logs->select();

        //print_r($select);

        return Twig::render('journaldebord.php', ['logs'=>$select]);

    }
}