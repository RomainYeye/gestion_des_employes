<?php
include "../CONTROLLERS/open.php";
include "../CONTROLLERS/fonctions.php";
include "../SERVICES/ServiceUser.php";
include_once "../MODELS/User.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>

    <?php

    $nameAlreadyUsed=false;

    if($_POST && isset($_POST["pushuser"]) && isset($_POST["username"]) && ($_POST["username"])!="" && isset($_POST["passuser"]) && ($_POST["passuser"])!="" && isset($_POST["role"]) && ($_POST["role"])!="") {
        $userDAO=new UserDataAccess();
        $userService=new ServiceUser($userDAO);
        $username=$_POST["username"];
        $data=$userService->selectAllWhereName($username);
        if (count($data)!=0) {
            $nameAlreadyUsed=true; //Si le nom utilisateur existe déjà, impossible de créer son compte, $nameAlreadyUsed passe à true et servira à afficher un message d'erreur.
        } else {
            $user=User::buildUser($_POST);
            $userService->add($user);//Si le nom utilisateur est disponible, création du compte.
            header("location: connexion.php");
        }
    }
    
    ?>

    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-6 offset-3 text-center">
                    <h1>Sign up</h1>
                </div>
                <div class="col-3 text-center">
                    <a class="btn btn-outline-secondary" href="connexion.php">Register</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 col-xs-12">
                    
                        <form method="post" action="signup.php">
                            <div class="row">
                                <label for="username">Nom de l'utilisateur</label>
                                <input class="form-control mb-3" type="text" name="username" placeholder="Saisissez le nom de l'user"/>
                            </div>
                            <?php if ($nameAlreadyUsed) {
                                echo '<div class="row justify-content-center bg bg-warning pt-5 pb-5">
                                        Ce nom d' . "'" . 'utilisateur existe déjà. Choisissez un autre nom d' . "'" . 'utilisateur.
                                      </div>'; } ?>
                            <div class="row">
                                <label for="passuser">Mot de passe</label>    
                                <input class="form-control mb-3" type="password" name="passuser" placeholder="Saisissez le mot de passe"/>
                            </div>
                            <div class="row">
                                <label for="role">Rôle</label> 
                                <input class="form-control mb-3" type="text" name="role" placeholder="Saisissez le rôle de l'user"/>
                            </div>
                            <div class="row justify-content-center">
                                <input class="btn btn-success w-100" name="pushuser" value="Valider" type="submit">
                            </div>
                        </form>
                
                </div>
            </div>
        </div>
    </div>

    </body>