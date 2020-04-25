<?php

include_once "../INTERFACES/DAOServiceInterface.php";

class ServiceDataAccess implements DAOServiceInterface {
    public function connectDataBase() {
        $db = new mysqli('localhost', 'root', '', 'registre');
        return $db;
    }

    public function selectAll() : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT * FROM services");
        $stmt->execute();
        $rs=$stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function add(object $service) : void {
        $db=$this->connectDataBase();
        $noservF=$service->getNoserv();
        $serviceF=$service->getService();
        $villeF=$service->getVille();
        $stmt=$db->prepare("insert into services values(?, ?, ?)");
        $stmt->bind_param("iss", $noservF, $serviceF, $villeF);
        $stmt->execute();
    }

    function edit(object $service) : void {
        $db=$this->connectDataBase();
        $noservF=$service->getNoserv();
        $serviceF=$service->getService();
        $villeF=$service->getVille();
        $stmt=$db->prepare("update services set NOSERV=?, SERVICE=?, VILLE=? where NOSERV=?");
        $stmt->bind_param("issi", $noservF, $serviceF, $villeF, $noservF);
        $stmt->execute();
    }

    public function dl(int $noserv) : void {
        $db=$this->connectDataBase();
        $servdl=$noserv;
        $stmt=$db->prepare("delete from services where NOSERV=?");
        $stmt->bind_param("i", $servdl);
        $stmt->execute();
    }

    public function exportDb() {
        $db=$this->connectDataBase();
        $myfile = fopen("services.csv" , "w+") or die ("Enable to open file !");
    
                $data=$this->selectAll($db);
                
                foreach (array_keys($data[0]) as $value) {
                            fwrite($myfile,$value . ";");
                        }
                fwrite($myfile, "\n");
    
                for($i=0;$i<count($data);$i++) {
                    foreach ($data[$i] as $value) {
                        fwrite($myfile, $value . ";");
                    }
                    fwrite($myfile, "\n");
                }
                fclose($myfile);
    }

    public function selectAllWhereNoService($service) : array {
        $db=$this->connectDataBase();
        $serviceF=$service;
        $stmt=$db->prepare("SELECT * FROM services WHERE NOSERV=?");
        $stmt->bind_param("i", $serviceF);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        return $data;
        $rs->free();
    }

    public function selectAWhereServIs($a, $b) : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT $a FROM services WHERE NOSERV=?");
        $stmt->bind_param("i", $b);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        return $data[0]["$a"];
        $rs->free();
    }

    public function selectAllWhere($colonne, $info) : array {
        $db=$this->connectDataBase();
        $rs = mysqli_query($db, "SELECT * FROM services where $colonne='$info'");
        $data = mysqli_fetch_all($rs, MYSQLI_ASSOC);
        return $data;
    }
    

}

?>