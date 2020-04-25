<?php

include_once("ServiceInterface.php");

interface ServiceEmployeInterface extends ServiceInterface {

    public function selectAWhereServIs($a, $b) : array;

    public function selectAWhereEmpIs($a, $b) : array;

    public function recherche(array $tab) : array;

}

?>