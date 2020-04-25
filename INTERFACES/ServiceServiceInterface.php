<?php

include_once("ServiceInterface.php");

interface ServiceServiceInterface extends ServiceInterface {

    public function selectAWhereServIs($a, $b) : array;

    public function selectAllWhere($colonne, $info) : array;
}

?>