<?php
include "open.php";
include "fonctions.php";
include_once "../SERVICES/ServiceEmploye.php";
include_once "../SERVICES/ServiceService.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire Gestion Effectifs</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>

    <?php
    
    $valNoemp="";
    $valNom="";
    $valPrenom="";
    $valEmploi="";
    $valSup="";
    $valEmbauche="";
    $valSal="";
    $valCom="";
    $valNoserv="";

    $titre="d'ajout";

    if($_GET) {
        if(isset($_GET["edit"])) {
            $employeDAO=new EmployeDataAccess();
            $employeService=new ServiceEmploye($employeDAO);
            $data=$employeService->selectAWhereEmpIs("*", $_GET["edit"]);
            $valNoemp=$data[0]["NOEMP"];
            $valNom=$data[0]["NOM"];
            $valPrenom=$data[0]["PRENOM"];
            $valEmploi=$data[0]["EMPLOI"];
            $valSup=$data[0]["SUP"];
            $valEmbauche=$data[0]["EMBAUCHE"];
            $valSal=$data[0]["SAL"];
            $valCom=$data[0]["COM"];
            $valNoserv=$data[0]["NOSERV"];
            $titre="d'édition";
        }
    }
    ?>



    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <h1>Formulaire <?php echo $titre ?></h1>
            </div>
            <div class="row justify-content-center alert alert-warning error-message" style="display: none">

            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 col-xs-12">
                    
                        <form id="form-emp" class="row w-100" method="post" action="<?php if($_GET) {
                                                                echo 'main_page.php?edit';
                                                            } else { 
                                                                echo 'main_page.php';
                                                                }?>">
                                            
                                                <div class="col-12">    
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6 col-md-9 col-sm-12 text-center">
                                                            <label class="w-50 m-auto" for="noemp">N° employé</label>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center mb-3">
                                                        <div class="col-lg-6 col-md-9 col-sm-12 w-50">
                                                            <div class="row justify-content-center">
                                                                <input  class="form-control text-center w-50" type="number" name="noemp" 
                                                                            placeholder="Saisissez le n° de l'employé" value = "<?php echo $valNoemp?>" required />
                                                                <?php 
                                                                if(isset($_GET["edit"])) {
                                                                    echo '<input class="form-control" type="hidden" name="noemp-original" value="'. $valNoemp .'"/>';
                                                                } 
                                                                else {echo '<input class="form-control" type="hidden" name="noemp-original" value="'. $valNoemp .'"/>';}
                                                                ?>
                                                               
                                                            </div>
                                                       </div>
                                                    </div> 
                                                </div>
                                                    
                                                <div class="col-12">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="row mb-lg-0 mb-md-0 mb-sm-3">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="nom">Nom</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">
                                                                    <input class="form-control" type="text" name="nom"
                                                                                    placeholder="Saisissez le nom de l'employé" value = "<?php echo $valNom?>" required/>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="prenom">Prénom</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">    
                                                                    <input class="form-control" type="text" name="prenom"
                                                                                placeholder="Saisissez le prénom de l'employé" value = "<?php echo $valPrenom?>" required/>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-6 col-md-6  col-sm-12">
                                                            <div class="row mb-lg-0 mb-md-0 mb-sm-3">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="nom">Emploi</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">
                                                                    <input class="form-control" type="text" name="emploi"
                                                                                    placeholder="Saisissez l'emploi de l'employé" value = "<?php echo $valEmploi?>"required/>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="prenom">Supérieur</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">    
                                                                    <input class="form-control" type="number" name="sup"
                                                                                placeholder="Saisissez le n° du supérieur de l'employé" value = "<?php echo $valSup?>"/>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="row mb-lg-0 mb-md-0 mb-sm-3">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="nom">Date d'embauche</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">
                                                                    <input class="form-control" type="date" name="embauche"
                                                                                    placeholder="Saisissez la date d'embauche de l'employé" value = "<?php echo $valEmbauche?>" required/>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="prenom">Salaire</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">    
                                                                    <input class="form-control" type="number" name="sal"
                                                                                placeholder="Saisissez le salaire de l'employé" value = "<?php echo $valSal?>" required/>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="row mb-5">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="row mb-lg-0 mb-md-0 mb-sm-3">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="nom">Commission</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">
                                                                    <input class="form-control" type="number" name="com"
                                                                                    placeholder="Saisissez la commission de l'employé" value = "<?php echo $valCom?>" />
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 -sm-12">
                                                            <div class="row">
                                                                <div class="col-3 mt-auto mb-auto">
                                                                    <label class="mt-auto mb-auto" for="noserv">N° de service</label>
                                                                </div>
                                                                <div class="col-1 mt-auto mb-auto m-0 p-0">
                                                                    :
                                                                </div>
                                                                <div class="col-7 m-0 p-0">
                                                                    <select name="noserv" class="form-control selectpicker show-tick">
                                                                        <?php
                                                                        $serviceDAO=new ServiceDataAccess();
                                                                        $serviceService=new ServiceService($serviceDAO); 
                                                                        $data2=$serviceService->selectAll();
                                                                        for($i=0; $i<count($data2); $i++){
                                                                            echo'<option value="' . $data2[$i]["NOSERV"] . '"'; if($valNoserv==$data2[$i]["NOSERV"]) {echo 'selected';} echo '>' . $data2[$i]["SERVICE"] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <?php 
                                                        if(isset($_GET["edit"])) {
                                                            echo '<input class="form-control" type="hidden" name="edit-emp"/>';
                                                            echo '<input id="edit-emp" class="btn btn-success w-100" value="Editer" type="submit"/>';
                                                        }
                                                        else {
                                                            echo '<input class="form-control" type="hidden" name="add-emp"/>';
                                                            echo '<input id="add-emp" class="btn btn-success w-100" value="Ajouter" type="submit"/>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                        </form>
                
                </div>
            </div>
        </div>
    </div>

    </body>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="script.js" type="text/javascript"></script>