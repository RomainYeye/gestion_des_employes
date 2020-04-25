<?php

include_once("DAOInterface.php");

interface DAOUserInterface extends DAOInterface {

    public function controlPassDB($username, $password) : bool;    
    
    public function getRoleFromName($name) : string;

    public function selectAllWhere($colonne, $info) : array;

}