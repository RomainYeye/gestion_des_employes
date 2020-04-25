<?php

include_once "../MODELS/Service.php";
include_once "../INTERFACES/ServiceServiceInterface.php";
include_once "../DAO/ServiceDataAccess.php";

class ServiceService implements ServiceServiceInterface {
    private $dAOService;

    public function __construct(DAOInterface $serviceService) {
        $this->dAOService = $serviceService;
    }

    public function connectDataBase() {
        $db = mysqli_init();
        mysqli_real_connect($db, 'localhost', 'root', '', 'registre');
        return $db;
    }

    public function selectAll() : array {
        $data=$this->dAOService->selectAll();
        return $data;
    }

    public function add(object $service) : void {
        $this->dAOService->add($service);
    }

    function edit(object $service) : void {
        $this->dAOService->edit($service);
    }

    public function dl(int $noserv) : void {
        $this->dAOService->dl($noserv);
    }

    public function exportDb() {
        $this->dAOService->exportDb();
    }

    public function selectAWhereServIs($a, $b) : array {
        $data=$this->dAOService->selectAWhereServIs($a, $b);
        return $data;
    }

    public function selectAllWhere($colonne, $info) : array {
        $data=$this->dAOService->selectAllWhere($colonne, $info);
        return $data;
    }

}


?>