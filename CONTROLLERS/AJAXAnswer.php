<?php
include_once "../DAO/EmployeDataAccess.php";
include_once "../SERVICES/ServiceEmploye.php";
include_once "../EXCEPTIONS/ExceptionServiceEmploye.php";
include_once "../EXCEPTIONS/ExceptionServiceDbEmploye.php";


    if (isset($_POST["delete-emp"])) {
        $employeDAO=new EmployeDataAccess();
        $employeService=new ServiceEmploye($employeDAO);
        try { 
            $employeService->dl($_POST["id-emp"]);
        } catch (ExceptionServiceEmploye $mce) {
            $errorCode=$mce->getCode();
            if($errorCode=="1451") {
                echo "Il n'est pas possible de supprimer un employé qui a des subalternes.";
            }
        }
        catch (ExceptionServiceDbEmploye $mcde) {
            $errorCode=$mcde->getCode();
            if($errorCode=="1045") {
                echo "Erreur de connexion à la base de données.";
            }
        } 
    }

    if (isset($_POST["add-emp"])) {
        $employeDAO=new EmployeDataAccess();
        $employeService=new ServiceEmploye($employeDAO);
        try {
            $employe=Employe::buildEmploye($_POST);
            $employeService->add($employe);
        } catch (ExceptionServiceEmploye $mce) {
            $errorCode= $mce->getCode();
            if($errorCode=="1062") {
                echo "Ce numéro d'employé est déjà attribué.";
            }
            if($errorCode=="1452") {
                echo "Le supérieur n° " . $_POST["sup"] . " n'existe pas.";
            }
        } catch (ExceptionServiceDbEmploye $mcde) {
            $errorCode=$mcde->getCode();
            if($errorCode=="1045") {
                echo "Erreur de connexion à la base de données.";
            }
        }
    }

    if (isset($_POST["edit-emp"])) {
        $caught=false;
        $employeDAO=new EmployeDataAccess();
        $employeService=new ServiceEmploye($employeDAO);
        try {
            $employe=Employe::buildEmploye($_POST); 
            $employeService->edit($employe);
        } catch (ExceptionServiceEmploye $mce) {
            $caught=true;
            $errorCode=$mce->getCode();
            if($errorCode=="1062") {
                echo "Ce numéro d'employé est déjà attribué.";
            }
            if($errorCode=="1452") {
                echo "Le supérieur n° " . $_POST["sup"] . " n'existe pas.";
            }
        }
        catch (ExceptionServiceDbEmploye $mcde) {
            $caught=true;
            $errorCode=$mcde->getCode();
            if($errorCode=="1045") {
                echo "Erreur de connexion à la base de données.";
            }
        }
    }

        
    