<?php

class Connect{
    public static function connect(){
        $db = new mysqli("localhost", "root", "", "links");
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}

?>