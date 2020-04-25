<?php
    include "../CONTROLLERS/open.php";
    include "../CONTROLLERS/fonctions.php";
    include_once "../SERVICES/ServiceUser.php";
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

    $messageErreur="";

    if($_GET){
        $userDAO=new UserDataAccess();
        $userService=new ServiceUser($userDAO);
        if(isset($_GET["connexion"]) && isset($_GET["username"]) && $_GET["username"]!="" && isset($_GET["password"]) && $_GET["password"]!="" && $userService->controlPassDB($_GET["username"], $_GET["password"])) {
            session_start();
            $_SESSION["nameuser"]=$_GET["username"];
            header("location: main_page.php");
        } else {
            $messageErreur="Erreur de saisie";
        }
    }

    ?>

    <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center mb-5 mt-5">
                    <h1>Connexion</h1>
                </div>
                <form class="bg-light mb-3" method="get" action="connexion.php">
                    <div class="row justify-content-center pt-4 mb-2">
                        <div class="ml-5 col-lg-4 col-sm-4 col-sm-12">
                            <label for="username">Nom de l'utilisateur</label>
                        </div>
                        <div class="col-lg-6 col-sm-6 lg-mr-5 md-mr-5 sm-mr-0 col-sm-12">
                            <input class="form-control" type="text" name="username" placeholder="Saisissez le nom de l'utilisateur">
                        </div>
                    </div>
                    <div class="row justify-content-center mb-4">
                        <div class="ml-5 col-lg-4 col-sm-4 col-sm-12">
                            <label for="password">Mot de passe</label>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-sm-12 lg-mr-5 md-mr-5 sm-mr-0">
                            <input class="form-control" type="password" name="password" placeholder="Saisissez le mot de passe">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn btn-success w-100" name ="connexion" type="submit" value="Valider">
                    </div>
                </form>
                <?php if ($messageErreur) {
                    echo '<div class="row justify-content-center">
                                <div class="col-4 pt-2 pb-2 text-center bg-warning mb-4">' .
                            $messageErreur .
                          '</div>
                            </div>';
                }
                ?>
                <div class="row justify-content-center">
                    <form method="post" action="signup.php">
                        <input class="btn btn-outline-secondary w-100" name ="inscription" type="submit" value="Pas encore inscrit ?">
                    </form>
                </div>
    
    </body>
