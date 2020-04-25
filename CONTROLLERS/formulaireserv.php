<?php
include "open.php";
include "fonctions.php";
include_once "../SERVICES/ServiceService.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire Gestion Services</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>

    <?php

    $titre="d'ajout";
    $valNoserv="";
    $valService="";
    $valVille="";

    if($_GET) {
        if(isset($_GET["editserv"])) {
            $serviceDAO=new ServiceDataAccess();
            $serviceService=new ServiceService($serviceDAO);
            $data=$serviceService->selectAllWhere("NOSERV", $_GET["editserv"]);
            $valNoserv=$data[0]["NOSERV"];
            $valService=$data[0]["SERVICE"];
            $valVille=$data[0]["VILLE"];
            $titre="d'édition";
        }
    }
    
    ?>
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center mt-5">
                    <h1>Formulaire <?php echo $titre ?> Service</h1>
                </div>
                <form class="bg bg-light pt-3 pb-3" method="post" action="<?php if($_GET) {
                                                                echo 'main_page_services.php?editserv';
                                                            } else { 
                                                                echo 'main_page_services.php';
                                                                }?>">
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="username">NOSERV</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control" type="text" name="noserv" placeholder="Saisissez le numéro du service" value="<?php echo $valNoserv ?>"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="username">SERVICE</label>
                        </div>
                        <div class="col-9">    
                            <input class="form-control" type="text" name="service" placeholder="Saisissez le rôle de l'utilisateur" value="<?php echo $valService ?>"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="username">VILLE</label>
                        </div>
                        <div class="col-9">    
                            <input class="form-control" type="text" name="ville" placeholder="Saisissez le rôle de l'utilisateur" value="<?php echo $valVille ?>"/>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn btn-success w-100" name="posteditserv" value="Valider" type="submit">
                    </div>
                </form>
            </div>
        </div>



    </body>
</html>
