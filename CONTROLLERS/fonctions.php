<?php

function addEmp($noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $com, $noserv) {
    global $db;
    $noempF=$noemp;
    $nomF=$nom?$nom:null;
    $prenomF=$prenom?$prenom:null;
    $emploiF=$emploi?$emploi:null;
    $supF=$sup?$sup:'null';
    $embaucheF=$embauche?$embauche:'null';
    $salF=$sal?$sal:'null';
    $comF=$com?$com:'null';
    $noservF=$noserv;
    mysqli_query($db, "insert into employes values($noempF,'$nomF','$prenomF','$emploiF',$supF,$embaucheF,$salF,$comF,$noservF)");
}

function editEmp($noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $com, $noserv) {
    global $db;
    $noempF=$noemp;
    $nomF=$nom?$nom:null;
    $prenomF=$prenom?$prenom:null;
    $emploiF=$emploi?$emploi:null;
    $supF=$sup?$sup:'null';
    $embaucheF=$embauche?$embauche:'null';
    $salF=$sal?$sal:'null';
    $comF=$com?$com:'null';
    $noservF=$noserv;
    mysqli_query($db,"update employes set
                                    NOEMP=$noempF,
                                    NOM='$nomF',
                                    PRENOM='$prenomF',
                                    EMPLOI='$emploiF',
                                    SUP=$supF,
                                    EMBAUCHE='$embaucheF',
                                    SAL=$salF,
                                    COM=$comF,
                                    NOSERV=$noservF
                                    where NOEMP='$noempF'");
}

function dlEmp($noemp) {
    global $db;
    $empdl=$noemp;
    mysqli_query($db, "delete from employes where NOEMP='$empdl'");
}

function selectAll($db, $table) {
    $rs = mysqli_query($db, "SELECT * FROM $table");
    $data = mysqli_fetch_all($rs, MYSQLI_ASSOC);
    return $data;
}

function selectAllWhere($db, $table, $critere1, $critere2, $critere3) {
    $rs = mysqli_query($db, "SELECT * FROM $table WHERE $critere1 $critere2 $critere3");
    $data = mysqli_fetch_all($rs, MYSQLI_ASSOC);
    return $data;
}

function exportDb($table) {
    global $db;
    $myfile = fopen("texte.csv" , "w+") or die ("Enable to open file !");

            $data=selectAll($db, $table);
            
            foreach (array_keys($data[0]) as $value) {
                        fwrite($myfile,$value . ";");
                    }
            fwrite($myfile, "\n");

            for($i=0;$i<count($data);$i++) {
                foreach ($data[$i] as $value) {
                    fwrite($myfile, $value . ";");
                }
                fwrite($myfile, "\n");
            }
            fclose($myfile);
}

function restrainDis($service) {
    global $db;
    if($service != "all"){
        $serviceF=$service;
        $rs = mysqli_query($db, "SELECT a.* FROM employes AS a INNER JOIN services AS b ON a.NOSERV=b.NOSERV WHERE SERVICE='$serviceF'");
        $data = mysqli_fetch_all($rs, MYSQLI_ASSOC);
    }
    if($_GET["serv"] == "all"){
        $data=selectAll($db, "employes");
    }
    return $data;
}

function passControl($userP, $passwordP, $user, $password) {
    $crypPass=password_hash($password, PASSWORD_DEFAULT);
    if($userP == $user && password_verify($passwordP, $crypPass)) {
        session_start();
        $_SESSION["mail_user"]="abcd@abc.com";
        header("location: main_page.php");
    }
}

function insertUser($username, $password, $role) {
    global $db;
    $usernameF=$username;
    $passwordF=$password;
    $crypPass=password_hash($passwordF,PASSWORD_DEFAULT);
    $roleF=$role;
    $query="insert into user values(NULL,'$usernameF','$crypPass','$roleF')";
    mysqli_query($db, $query);
}

function controlPassDB($username, $password) {
    global $db;
    $check=false;
    $testusername=$username;
    $testpass=$password;
    $test=selectAll($db, "user");
    for($i=0;$i<count($test);$i++) {
        if ($testusername==$test[$i]["username"] && password_verify($testpass,$test[$i]["password"])){
            $check=true;
        }
            
    }
    return $check;
}

function ifAdmin($name) {
    global $db;
    $test=selectAll($db, "user");
    for($i=0;$i<count($test);$i++) {
        if ($name==$test[$i]["username"] && $test[$i]["role"]=="admin"){
            return true;
            break;
        }
    }
}

function ifAdminNew($name) {
    $name2=getRoleFromName($name);
    if ($name2[0]["role"]=="admin"){
        return true;
    }
}


function getRoleFromName($name) {
    global $db;
    $rs = mysqli_query($db, "SELECT role FROM user where username='$name'");
    $data = mysqli_fetch_all($rs, MYSQLI_ASSOC);
    return $data;
}


function displayTable($data, $admin, $yon) {
    echo '  <table class="table table-hover">
                    <thead>
                        <tr>';
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
                                        echo    '<td class="text-center"><a class="btn btn-sm btn-outline-secondary mr-2" href="formulaireuser.php?edituser=' . $data[$i]["id_user"] . '">Edit</a><a class="btn btn-outline-danger btn-sm" href="main_page_utilisateurs.php?dluser=' . $data[$i]["id_user"] . '">Supprimer</a></td>';
                                        echo '</tr>';
                                        }
                                    if($admin && $yon=="serv") {
                                        echo    '<td class="text-center"><a class="btn btn-sm btn-outline-secondary mr-2" href="formulaireserv.php?editserv=' . $data[$i]["NOSERV"] . '">Edit</a><a class="btn btn-outline-danger btn-sm" href="main_page_services.php?dlserv=' . $data[$i]["NOSERV"] . '">Supprimer</a></td>';
                                        echo '</tr>';
                                        }
                                        
                                }

                    echo '</tbody>
                </table>
            </div>';
}




