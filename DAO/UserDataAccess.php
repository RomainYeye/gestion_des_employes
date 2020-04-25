<?php

include_once ("../INTERFACES/DAOUserInterface.php");

class UserDataAccess implements DAOUserInterface {
    public function connectDataBase() {
        $db = new mysqli('localhost', 'root', '', 'registre');
        return $db;
    }
    

    public function selectAll() : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT * FROM user");
        $stmt->execute();
        $rs=$stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function add(object $user) : void {
        $db=$this->connectDataBase();
        $usernameF=$user->getUsername();
        $passwordF=$user->getPassword();
        $crypPass=password_hash($passwordF,PASSWORD_DEFAULT);
        $roleF=$user->getRole();
        $stmt=$db->prepare("insert into user values(NULL, ?, '$crypPass', ?)");
        $stmt->bind_param("ss", $usernameF, $roleF);
        $stmt->execute();
    }

    function edit(object $user) : void {
        $db=$this->connectDataBase();
        $usernameF=$user->getUsername();
        $roleF=$user->getRole();
        $stmt=$db->prepare("update user set username=?,role=? where username=?");
        $stmt->bind_param("sss", $usernameF, $roleF, $usernameF);
        $stmt->execute();
    }

    public function dl(int $nouser) : void {
        $db=$this->connectDataBase();
        $userdl=$nouser;
        $stmt=$db->prepare("delete from user where id_user=?");
        $stmt->bind_param("i", $userdl);
        $stmt->execute();
    }

    public function selectPassFromName($username) : ?string {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("select password from user where username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data = $rs->fetch_array(MYSQLI_ASSOC);
        return ($data!=null) ? $data["password"] : null;
    }

    public function controlPassDB($username, $password) : bool {
            $check=false;
            $test=$this->selectPassFromName($username);
            if ($test && password_verify($password,$test)==true){
                $check=true;
            }
            return $check;
    }
    

    public function getRoleFromName($name) : string {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT role FROM user where username=?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data = $rs->fetch_array(MYSQLI_ASSOC);
        return $data["role"];
    }

    public function exportDb() {
        $db=$this->connectDataBase();
        $myfile = fopen("users.csv" , "w+") or die ("Enable to open file !");
    
                $data=$this->selectAll($db);
                
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

    public function selectAllWhereName($username) : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT * FROM user where username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data=$rs->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function selectAllWhereId($id_user) : array {
        $db=$this->connectDataBase();
        $stmt=$db->prepare("SELECT * FROM user where id_user=?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $rs=$stmt->get_result();
        $data=$rs->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function selectAllWhere($colonne, $info) : array {
        $db=$this->connectDataBase();
        $rs = mysqli_query($db, "SELECT * FROM user where $colonne='$info'");
        $data = mysqli_fetch_all($rs, MYSQLI_ASSOC);
        return $data;
    }

}

?>