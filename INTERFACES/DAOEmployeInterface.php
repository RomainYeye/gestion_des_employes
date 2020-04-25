<?php

include_once("DAOInterface.php");

interface DAOEmployeInterface extends DAOInterface {

    public function selectAWhereServIs($a, $b) : array;

    public function selectAWhereEmpIs($a, $b) : array;

    public function recherche($request, $type, $arrayOfValues) : array;

}

?>



    