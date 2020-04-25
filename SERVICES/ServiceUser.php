<?php

include_once "../DAO/UserDataAccess.php";
include_once "../INTERFACES/ServiceUserInterface.php";
include_once "../INTERFACES/DAOUserInterface.php";

class ServiceUser implements ServiceUserInterface {
    private $dAOUser;

    public function __construct(DAOInterface $userService) {
        $this->dAOUser = $userService;
    }

    public function selectAll() : array {
        $data=$this->dAOUser->selectAll();
        return $data;
    }

    public function add(object $user) : void {
        $this->dAOUser->add($user);
    }

    public function edit(object $user) : void{
        $this->dAOUser->edit($user);
    }

    public function dl(int $nouser) : void{
        $this->dAOUser->dl($nouser);
    }

    public function selectPassFromName($username) : string {
        $data=$this->dAOUser->selectPassFromName($username);
        return $data;
    }

    public function controlPassDB($username, $password) : bool {
        $check=$this->dAOUser->controlPassDB($username, $password);
        return $check;
    }

    public function selectAllWhereName($username) : array {
        $data=$this->dAOUser->selectAllWhereName($username);
        return $data;
    }

    public function selectAllWhereId($id_user) : array{
        $data=$this->dAOUser->selectAllWhereId($id_user);
        return $data;
    }

    public function selectAllWhere($colonne, $info) : array{
        $data=$this->dAOUser->selectAllWhere($colonne, $info);
        return $data;
    }

    public function getRoleFromName(string $username) : string{
        $data=$this->dAOUser->getRoleFromName($username);
        return $data;
    }

    public function exportDb() {
        $this->dAOUser->exportDb();
    }
    

    
}
?>