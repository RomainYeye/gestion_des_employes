<?php 
    include_once("../SERVICES/ServiceEmploye.php");
    session_start();

    $admin=false;

        if($_SESSION["role"]=="admin") {
            $admin=true;
        }

        $data=null;

        if(!isset($_POST["noserv"])){
            $employeDao=new EmployeDataAccess();
            $employeService = new ServiceEmploye($employeDao);
            try {
                $caught=false;
                $data = $employeService->selectAll();
            } catch (ExceptionServiceDbEmploye $msbe) {
                $msbe->getCode();
                $caught=true;
                if($errorCode=="1045") {
                    echo "Erreur de connexion à la base de données.";
                }
            }
            if(!$caught) {
                displayTable($data, $admin, "employes");
            }
        }
        if(isset($_POST["noserv"])){
            $employeDao=new EmployeDataAccess();
            $employeService = new ServiceEmploye($employeDao);
            try {
                $caught=false;
                $data = $employeService->recherche($_POST);
            } catch (ExceptionServiceDbEmploye $msbe) {
                $errorCode=$msbe->getCode();
                $caught=true;
                if($errorCode=="1045") {
                    echo "Erreur de connexion à la base de données.";
                }
            }
            if(!$caught) {
                displayTable($data, $admin, "employes");
            }
        }
        
    function displayTable($data, $admin, $yon) {
        echo '
                        <table class="table table-hover">
                            <thead>
                                <tr>';
                                        if($data!=null) {
                                            if (count($data) != 0) {
                                                foreach (array_keys($data[0]) as $value) {
                                                    echo '<th scope="col" class="text-center">' . $value . '</th>';
                                                }
                                                if($admin) {
                                                echo '<th scope="col" colspan="2" class="text-center">Action</th>';
                                                }
                                            } else {
                                                echo '</tr>
                                                    </thead>
                                                    </table>
                                                    </div>
                                                        <div class="row justify-content-center">
                                                            Aucune valeur à afficher.
                                                        </div>';
                                            }
        
                                        
                                    echo '</tr>
                                </thead>
                                <tbody>';
                                            for($i=0;$i<count($data);$i++) {
                                                echo '<tr>';
                                                foreach ($data[$i] as $value2) {
                                                    echo '<td class="text-center">' . $value2 . '</td>';
                                                }
                                                if($admin && $yon=="employes") {
                                                    echo    '<td class="text-center"><a class="btn btn-sm btn-outline-secondary mr-2" href="formulaire.php?edit=' . $data[$i]["NOEMP"] . '">Edit</a><button class="btn btn-outline-danger btn-sm btndeleteemp" data-noemp="'. $data[$i]["NOEMP"] .'">Supprimer</button></td>';
                                                    echo '</tr>';
                                                    }
                                                if($admin && $yon=="user") {
                                                    echo    '<td class="text-center"><a class="btn btn-sm btn-outline-secondary mr-2" href="formulaireuser.php?edituser=' . $data[$i]["id_user"] . '">Edit</a><a class="btn btn-outline-danger btn-sm" href="main_page.php?dluser=' . $data[$i]["id_user"] . '">Supprimer</a></td>';
                                                    echo '</tr>';
                                                    }
                                                if($admin && $yon=="serv") {
                                                    echo    '<td class="text-center"><a class="btn btn-sm btn-outline-secondary mr-2" href="formulaireserv.php?editserv=' . $data[$i]["NOSERV"] . '">Edit</a><a class="btn btn-outline-danger btn-sm" href="main_page.php?dlserv=' . $data[$i]["NOSERV"] . '">Supprimer</a></td>';
                                                    echo '</tr>';
                                                    }
                                                    
                                            }
                                        }
            
                                echo '</tbody>
                            </table>
                        ';
                        return $yon;
    }

    

?>
    </tbody>
</table>


