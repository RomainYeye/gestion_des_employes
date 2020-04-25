<?php
include "open.php";
include "fonctions.php";
include_once "../SERVICES/ServiceUser.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire Gestion Utilisateurs</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>

    <?php

    $valUsername="";
    $valRole="";

    if($_GET) {
        if(isset($_GET["edituser"])) {
            $userDAO=new UserDataAccess();
            $userService=new ServiceUser($userDAO);
            $data=$userService->selectAllWhere("id_user", $_GET["edituser"]);
            $valUsername=$data[0]["username"];
            $valRole=$data[0]["role"];
            $titre="d'édition";
        }
    }
    
    ?>
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center mt-5">
                    <h1>Formulaire <?php echo $titre ?> Utilisateur</h1>
                </div>
                <form class="bg bg-light pt-3 pb-3" method="post" action="main_page_utilisateurs.php">
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="username">Changer Username</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control" type="text" name="username" placeholder="Saisissez le nom de l'utilisateur" value="<?php echo $valUsername ?>"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="username">Changer Rôle</label>
                        </div>
                        <div class="col-9">    
                            <input class="form-control" type="text" name="role" placeholder="Saisissez le rôle de l'utilisateur" value="<?php echo $valRole ?>"/>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <input class="btn btn-success w-100" name="postedituser" value="Valider" type="submit">
                    </div>
                </form>
            </div>
        </div>



    </body>
</html>
