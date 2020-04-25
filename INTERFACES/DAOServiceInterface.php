<?php

include_once("DAOInterface.php");

interface DAOServiceInterface extends DAOInterface {

    public function selectAWhereServIs($a, $b) : array;

    public function selectAllWhere($colonne, $info) : array;

}