<?php

class User {
    private $iduser;
    private $username;
    private $password;
    private $role;

    public static function buildUser($array) {
        $user=new User();
        
        $user->setUsername($array["username"])
             ->setPassword($array["passuser"])
             ->setRole($array["role"]);

        return $user;
    }

    /**
     * Get the value of iduser
     */ 
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set the value of iduser
     *
     * @return  self
     */ 
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}