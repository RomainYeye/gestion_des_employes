<?php

include_once "../DAO/EmployeDataAccess.php";
include_once "../MODELS/Employe.php";
include_once "../INTERFACES/ServiceEmployeInterface.php";
include_once "../INTERFACES/DAOEmployeInterface.php";
include_once "../EXCEPTIONS/ExceptionServiceEmploye.php";
include_once "../EXCEPTIONS/ExceptionServiceDbEmploye.php";

class ServiceEmploye implements ServiceEmployeInterface {
    private $dAOEmploye;
    
    public function __construct(DAOInterface $employeService) {
        $this->dAOEmploye = $employeService;
    }

    public function selectAll() : array {
        $data=$this->dAOEmploye->selectAll();
        return $data;
    }

    public function add(object $employe) : void {
        try {
            $this->dAOEmploye->add($employe);
        } catch (ExceptionDAOEmploye $mde) {
            throw new ExceptionServiceEmploye("Erreur SQL", $mde->getCode());
        } catch (ExceptionDAODbEmploye $mdde) {
            throw new ExceptionServiceDbEmploye("Erreur connexion", $mdde->getCode());
        }
    }

    public function edit(object $employe) : void {
        try {
            $this->dAOEmploye->edit($employe);
        } catch (ExceptionDAOEmploye $mde) {
            throw new ExceptionServiceEmploye("Erreur SQL", $mde->getCode());
        }
        catch (ExceptionDAODbEmploye $mdde) {
            throw new ExceptionServiceDbEmploye("Erreur connexion", $mdde->getCode());
        }
    }

    public function dl(int $employe) : void {
        try { $this->dAOEmploye->dl($employe);
        } catch (ExceptionDAOEmploye $mde) {
            throw new ExceptionServiceEmploye("Erreur SQL", $mde->getCode());
        }
        catch (ExceptionDAODbEmploye $mdde) {
            throw new ExceptionServiceDbEmploye("Erreur connexion", $mdde->getCode());
        }
    }

    public function recherche(array $tab) : array{
        $request="";
        $type="";
        $counter=1;
        $tabLength=count(array_filter($tab));
        foreach(array_filter($tab) as $key=> $value) {
            switch ($key) {
                case "noserv" :
                    $type.="i";
                    if($value=="all") {
                        $value="%";
                        $type="s";
                    }
                    if($counter<$tabLength) {
                        $request.="NOSERV like ? and ";
                    } else {
                        $request.= "NOSERV like ?";
                    }
                    
                    $arrayOfValues[$counter-1] = $value;
                    $counter++;
                    break;
                case "nom" : 
                    if($counter<$tabLength) {
                        $request.="NOM like ? and ";
                    } else {
                        $request.= "NOM like ?";
                    }
                    $type.="s";
                    $arrayOfValues[$counter-1] = $value . "%";
                    $counter++;
                    break;
                case "prenom" :
                    if($counter<$tabLength) {
                        $request.="PRENOM like ? and ";
                    } else {
                        $request.= "PRENOM like ?";
                    }
                    $type.="s";
                    $arrayOfValues[$counter-1] = $value . "%";
                    $counter++;
                    break;
                case "salmin" :
                    if($counter<$tabLength) {
                        $request.="SAL>? and ";
                    } else {
                        $request.= "SAL>?";
                    }
                    $type.="i";
                    $arrayOfValues[$counter-1] = $value;
                    $counter++;
                    break;
                case "salmax" :
                    if($counter<$tabLength) {
                        $request.="SAL<? and ";
                    } else {
                        $request.= "SAL<?";
                    }
                    $type.="i";
                    $arrayOfValues[$counter-1] = $value;
                    $counter++;
                break;
            }
        }
        try {
            $data=$this->dAOEmploye->recherche($request, $type, $arrayOfValues);
        } catch (ExceptionDAODbEmploye $mdde) {
            throw new ExceptionServiceDbEmploye("Erreur Connexion", $mdde->getCode());
        }
        return $data;
    }

    public function selectAWhereServIs($a, $b) : array {
        $data=$this->dAOEmploye->selectAWhereServIs($a, $b);
        return $data;
    }

    public function selectAWhereEmpIs($a, $b) : array {
        $data=$this->dAOEmploye->selectAWhereEmpIs($a, $b);
        return $data;
    }

    public function exportDb() {
        $this->dAOEmploye->exportDb();
    }
    
}

?>