<?php

include_once "../INTERFACES/DAOEmployeInterface.php";
include_once "../EXCEPTIONS/ExceptionDAOEmploye.php";
include_once "../EXCEPTIONS/ExceptionDaoDbEmploye.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class EmployeDataAccess implements DAOEmployeInterface {
    public function connectDataBase() {
        try {
            $db = new mysqli('localhost', 'root', '', 'registre');
            return $db;
        } catch (mysqli_sql_exception $mse) {
            throw new ExceptionDaoDbEmploye("Erreur connexion",$mse->getCode());
        }
    }

    public function disconnect($db) {
        $db->close();
    }
    
    public function selectAll() : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT * FROM employes");
        $stmt->execute();
        $rs=$stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        $rs->free();
        $this->disconnect($db);
        return $data;
    }

    public function add(object $employe) : void {
        $db=$this->connectDataBase();
        $noempF=$employe->getNoEmp();
        $nomF=$employe->getNom()?$employe->getNom():null;
        $prenomF=$employe->getPrenom()?$employe->getPrenom():null;
        $emploiF=$employe->getEmploi()?$employe->getEmploi():null;
        $supF=$employe->getSup()?$employe->getSup():null;
        $embaucheF=$employe->getEmbauche()?$employe->getEmbauche():'null';
        $salF=$employe->getSal()?$employe->getSal():'null';
        $comF=$employe->getCom()?$employe->getCom():null;
        $noservF=$employe->getNoserv();
        try {
            $stmt=$db->prepare("insert into employes values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssisddi", $noempF, $nomF, $prenomF, $emploiF, $supF, $embaucheF, $salF, $comF, $noservF);
            $stmt->execute();
        } catch (mysqli_sql_exception $mse) {
            throw new ExceptionDAOEmploye("Erreur SQL", $mse->getCode());
        } finally {
            $this->disconnect($db);
        }
    }
    
    public function edit(object $employe) : void {
        $db=$this->connectDataBase();
        $noempO=$employe->getNoempOriginal();
        $noempF=$employe->getNoemp();
        $nomF=$employe->getNom()?$employe->getNom():null;
        $prenomF=$employe->getPrenom()?$employe->getPrenom():null;
        $emploiF=$employe->getEmploi()?$employe->getEmploi():null;
        $supF=$employe->getSup()?$employe->getSup():null;
        $embaucheF=$employe->getEmbauche()?$employe->getEmbauche():'null';
        $salF=$employe->getSal()?$employe->getSal():'null';
        $comF=$employe->getCom()?$employe->getCom():null;
        $noservF=$employe->getNoserv();
        try {
            $stmt=$db->prepare("update employes set NOEMP=?, NOM=?,PRENOM=?,EMPLOI=?,SUP=?,EMBAUCHE=?,SAL=?,COM=?,NOSERV=? WHERE NOEMP=?");
            $stmt->bind_param("isssisddii", $noempF, $nomF, $prenomF, $emploiF, $supF, $embaucheF, $salF, $comF, $noservF, $noempO);
            $stmt->execute();
        } catch (mysqli_sql_exception $mse) {
            throw new ExceptionDAOEmploye("Erreur SQL", $mse->getCode());
        } finally {
            $this->disconnect($db);
        }
    }
    
    public function dl(int $noemp) : void {
        $db=$this->connectDataBase();
        $empdl=$noemp;
        try {
            $stmt=$db->prepare("delete from employes where NOEMP=?");
            $stmt->bind_param("i", $empdl);
            $stmt->execute();
        } catch (mysqli_sql_exception $mse) {
            throw new ExceptionDAOEmploye("Erreur SQL", $mse->getCode());
        }
        finally {
            $this->disconnect($db);
        }
    }

    public function recherche($request, $type, $arrayOfValues) : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("select * from employes where $request");
        $stmt->bind_param($type, ...$arrayOfValues);
        $stmt->execute();
        $rs=$stmt->get_result();            
        $data=$rs->fetch_all(MYSQLI_ASSOC); 
        $rs->free();
        $this->disconnect($db);
        return $data;
    }

    public function selectAWhereServIs($a, $b) : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT $a FROM employes WHERE NOSERV=?");
        $stmt->bind_param("i", $b);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data=$rs->fetch_all(MYSQLI_ASSOC);
        $rs->free();
        $this->disconnect($db);
        return $data;
    }

    public function selectAWhereEmpIs($a, $b) : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT $a FROM employes WHERE NOEMP=?");
        $stmt->bind_param("i", $b);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data=$rs->fetch_all(MYSQLI_ASSOC);
        $rs->free();
        $this->disconnect($db);
        return $data;
    }

    public function exportDb() {
        $db=$this->connectDataBase();
        $myfile = fopen("employes.csv" , "w+") or die ("Enable to open file !");
    
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
    
}

?>