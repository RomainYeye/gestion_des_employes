<?php

include_once("ServiceInterface.php");

interface ServiceUserInterface extends ServiceInterface {

    public function selectPassFromName($username) : string;

    public function controlPassDB($username, $password) : bool;

    public function selectAllWhereName($username) : array;

    public function selectAllWhereId($id_user) : array;

    public function selectAllWhere($colonne, $info) : array;

    public function getRoleFromName(string $username) : string;
}

?>