<?php
    include_once "../CONTROLLERS/open.php";
    include_once "../CONTROLLERS/fonctions.php";
    include_once "../SERVICES/ServiceEmploye.php";
    include_once "../SERVICES/ServiceService.php";
    include_once "../SERVICES/ServiceUser.php";
    include_once "../DAO/EmployeDataAccess.php";
    include_once "../DAO/ServiceDataAccess.php";
    include_once "../DAO/UserDataAccess.php";
    include_once "../MODELS/Employe.php";
    include_once "../MODELS/Service.php";
    include_once "../MODELS/User.php";


    session_start();
    if ($_SESSION["nameuser"]) {
    } else {
        header("location: connexion.php");
        exit;
    }
    if(isset($_POST["disconnect"])) {
        session_destroy();
        header("location: connexion.php");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gestion Effectifs</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
        
    <body>
    
        <?php

        $admin=false;
        $userDAO=new UserDataAccess();
        $userService=new ServiceUser($userDAO);
        $roleOfUser=$userService->getRoleFromName($_SESSION["nameuser"]);
        $_SESSION["role"]=$roleOfUser;
        
        if($roleOfUser=="admin") {
            $admin=true;
        }

        if(isset($_POST["exp"])) {
            $employeDAO= new EmployeDataAccess();
            $employeService=new ServiceEmploye($employeDAO);
            $employeService->exportDb();
        }

        /*if(isset($_POST["search"]) && !isset($_GET["serv"])) {
            if(isset($_POST["noserv"]) && isset($_POST["nom"]) && isset($_POST["nom"]) && isset($_POST["salmin"]) && isset($_POST["salmax"])){
                $employeDAO=new EmployeDataAccess();
                $employeService=new ServiceEmploye($employeDAO);
                $dataEmployes=$employeService->recherche($_POST);
            }
        }*/

        ?>
                            
        <div class="container-fluid">
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-auto col-md-auto col-sm-12 mt-3">
                        <?php echo '<h4 class="text-center">Bienvenue ' . $_SESSION["nameuser"] . ' (' . $roleOfUser . ')' . '</h4>'?>
                    </div>
                    <div class="col-lg-2 col-md-4 ml-auto text-right">
                        <form method="post" action="main_page.php">
                            <input type="hidden" name="disconnect" value="yes">
                            <input class="btn btn-outline-danger w-100" type="submit" value="Se déconnecter">
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center mb-4 mt-5 border-bottom">
                    <h1>Gestion des Employés</h1>
                </div>
                <div class="row justify-content-center">
                    <?php if($admin) {
                        echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 mb-sm-2 mb-xs-2">
                                <a class="btn btn-outline-dark w-100" href="main_page.php">Gestion des employés</a>
                              </div>';
                            echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 mb-sm-2 mb-xs-2">
                                    <a class="btn btn-outline-dark w-100" href="main_page_utilisateurs.php">Gestion des utilisateurs</a>
                                  </div>';
                                echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 mb-sm-2 mb-xs-2">
                                        <a class="btn btn-outline-dark w-100" href="main_page_services.php">Gestion des services</a>
                                      </div>';
                        }
                        ?>
                    </div>
                    <form method="post" action="main_page.php">
                        <div class="row justify-content-end">
                            <div class="col-lg-3 offset-lg-7 col-md-4 col-sm-6 col-xs-12 text-right">
                                <p>
                                    <?php if ($admin) { echo '<a class="btn btn-outline-info w-100" href="formulaire.php">Ajouter un employé</a>';}?>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 text-right">
                                <input type="hidden" name="exp" value="yes">                                                       
                                <input class="btn btn-outline-info w-100" type="submit"  value="Exporter">
                            </div>
                        </div>
                    </form>
                <!--<div class="row justify-content-end d-flex flex row mb-4">
                    <div class="col-lg-2 col-md-2 col-sm-12 <?php //if(!$admin) { echo 'mr-auto';}?>">
                        <div class="nav-item dropdown" >
                            <a class="nav-link dropdown-toggle btn btn-info" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Service</a>
                                <div class="bg-nv dropdown-menu p-1">
                                    <?php
                                    /*$serviceDAO=new ServiceDataAccess();
                                    $serviceService=new ServiceService($serviceDAO);
                                    $data2=$serviceService->selectAll();

                                    for($i=0; $i<count($data2); $i++){
                                        echo'<a class="bg-nv bg-info text-white dropdown-item pl-0 pr-0 text-center" href="main_page.php?serv=' . $data2[$i]["NOSERV"] . '">'. $data2[$i]["SERVICE"] .'</a>';
                                    }
                                    echo'<a class="bg-nv bg-dark font-weight-bold text-white dropdown-item pl-0 pr-0 text-center" href="main_page.php?serv=all">ALL</a>'*/
                                    ?>                           
                                </div>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-12">
                
                        

                        <?php
                        if(!isset($_GET["listofusers"]) && !isset($_GET["listofserv"])) {
                            echo '<div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <button type="button" class="btn btn-info w-100" id="menujs">+</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="formmenujs" style="display: none">
                                            <div class="row justify-content-around">
                                                <div class="col-lg-3">
                                                        <select id="select" name="noserv" class="form-control selectpicker show-tick">
                                                            <option value="all">Tous les services</option>';
                                                            $serviceDAO=new ServiceDataAccess();
                                                            $serviceService=new ServiceService($serviceDAO);
                                                            $data2=$serviceService->selectAll();
                                                            for($i=0; $i<count($data2); $i++){
                                                                echo'<option value="' . $data2[$i]["NOSERV"] . '"'; /*if($valNoserv==$data2[$i]["NOSERV"]) {echo 'selected';}*/ echo '>' . $data2[$i]["SERVICE"] . '</option>';
                                                            }
                                        echo '            </select>
                                                </div>
                                                    <div class="col-lg-2 col-md-3 col-sm-6 mb-sm-2">
                                                        <input id="nom" class="form-control" type="text" name="nom" placeholder="Nom"/>
                                                    </div>
                                                    <div class="col-lg-2 col-md-3 col-sm-6 mb-sm-2">    
                                                        <input id="prenom" class="form-control" type="text" name="prenom" placeholder="Prénom"/>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-6 mb-sm-2">
                                                        <input id="salmin" class="form-control" type="number" name="salmin" placeholder="Salaire min"/>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-6 mb-sm-2">
                                                        <input id="salmax" class="form-control" type="number" name="salmax" placeholder="Salaire max"/>
                                                    </div>
                                            </div>
                                        </div>
                                </div>';
                        }
                        ?>

                    </div>
                </div>

                
                    <div class="row justify-content-center error-message alert alert-warning" style="display: none">
                        
                    </div>
                

                <div id="ptable">
                    <?php
                    /*if(isset($_GET["serv"])) {
                            $employeDAO=new EmployeDataAccess();
                            $employeService=new ServiceEmploye($employeDAO);
                            $service=$_GET["serv"];
                            if($service != "all"){
                                $dataEmployes=$employeService->selectAWhereServIs("*", $service);
                                displayTable($dataEmployes, $admin, "employes");
                            }
                            else {
                                $dataEmployes=$employeService->selectAll();
                                displayTable($dataEmployes, $admin, "employes");
                            }
                    }/* /*else if (!isset($_POST["noserv"])){
                        $employeDao=new EmployeDataAccess();
                        $employeService = new ServiceEmploye($employeDao);
                        try {
                            $data = $employeService->selectAll();
                        } catch (ExceptionServiceEmploye $mce) {
                            echo $mce->getCode();
                        }
                    }*/
                                 
                    ?>
                </div>
            
            </div>
        
        </div>
    </body>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
</html>