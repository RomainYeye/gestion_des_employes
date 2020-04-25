<?php

    include_once "../CONTROLLERS/open.php";
    include_once "../CONTROLLERS/fonctions.php";
    include_once "../SERVICES/ServiceService.php";
    include_once "../DAO/ServiceDataAccess.php";
    include_once "../MODELS/Service.php";
    include_once "../SERVICES/ServiceUser.php";
    include_once "../DAO/UserDataAccess.php";
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
        if($roleOfUser=="admin") {
            $_SESSION["role"]="admin";
            $admin=true;
        } else header("location: main_page.php");

        if(isset($_POST["posteditserv"]) && !isset($_GET["editserv"])) {
            $serviceDAO=new ServiceDataAccess();
            $serviceService=new ServiceService($serviceDAO);
            $service=Service::buildService($_POST);
            $serviceService->add($service);
        }

        if(isset($_POST["posteditserv"])) {
            $serviceDAO=new ServiceDataAccess();
            $serviceService=new ServiceService($serviceDAO);
            $service=Service::buildService($_POST);
            $serviceService->edit($service);
        }

        if(!$_POST && $_GET) {
            if (isset($_GET["dlserv"])) {
                $serviceDAO= new ServiceDataAccess();
                $serviceService= new ServiceService($serviceDAO);
                $serviceService->dl($_GET["dlserv"]);
            }
        }

        if(isset($_POST["exp"])) {
            $serviceDAO=new ServiceDataAccess();
            $serviceService=new ServiceService($serviceDAO);
            $serviceService->exportDb();
        }

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
                    <h1>Gestion des Services</h1>
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
                    <form method="post" action="main_page_services.php">
                        <div class="row justify-content-end">
                            <div class="col-lg-2 offset-lg-8 col-md-4 col-sm-6 col-xs-12 text-right">
                                <p>
                                    <a class="btn btn-outline-info w-100" href="formulaireserv.php">Ajouter un service</a>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 text-right">
                                <input type="hidden" name="exp" value="yes">                                                       
                                <input class="btn btn-outline-info w-100" type="submit"  value="Exporter">
                            </div>
                        </div>
                    </form>
                    
                    <?php
                    $serviceDAO=new ServiceDataAccess();
                    $serviceService=new ServiceService($serviceDAO);
                    $dataServices=$serviceService->selectAll();
                    displayTable($dataServices, $admin, "serv");
                    ?>
                </div>
            
            </div>
        
        </div>
    </body>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
</html>