<?php

class Employe {
    private $noempOriginal;
    private $noemp;
    private $nom;
    private $prenom;
    private $emploi;
    private $sup;
    private $embauche;
    private $sal;
    private $com;
    private $noserv;

    public static function buildEmploye($array) {
            $employe=new Employe();

            $employe->setNoempOriginal($array["noemp-original"])
                    ->setnoemp($array["noemp"])
                    ->setnom($array["nom"])
                    ->setprenom($array["prenom"])
                    ->setemploi($array["emploi"])
                    ->setsup($array["sup"])
                    ->setembauche($array["embauche"])
                    ->setsal($array["sal"])
                    ->setcom($array["com"])
                    ->setnoserv($array["noserv"]);

            return $employe;
    }

   
    /**
     * Get the value of noemp
     */ 
    public function getNoemp()
    {
        return $this->noemp;
    }

    /**
     * Set the value of noemp
     *
     * @return  self
     */ 
    public function setNoemp($noemp)
    {
        $this->noemp = $noemp;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of emploi
     */ 
    public function getEmploi()
    {
        return $this->emploi;
    }

    /**
     * Set the value of emploi
     *
     * @return  self
     */ 
    public function setEmploi($emploi)
    {
        $this->emploi = $emploi;

        return $this;
    }

    /**
     * Get the value of sup
     */ 
    public function getSup()
    {
        return $this->sup;
    }

    /**
     * Set the value of sup
     *
     * @return  self
     */ 
    public function setSup($sup)
    {
        $this->sup = $sup;

        return $this;
    }

    /**
     * Get the value of embauche
     */ 
    public function getEmbauche()
    {
        return $this->embauche;
    }

    /**
     * Set the value of embauche
     *
     * @return  self
     */ 
    public function setEmbauche($embauche)
    {
        $this->embauche = $embauche;

        return $this;
    }

    /**
     * Get the value of sal
     */ 
    public function getSal()
    {
        return $this->sal;
    }

    /**
     * Set the value of sal
     *
     * @return  self
     */ 
    public function setSal($sal)
    {
        $this->sal = $sal;

        return $this;
    }

    /**
     * Get the value of com
     */ 
    public function getCom()
    {
        return $this->com;
    }

    /**
     * Set the value of com
     *
     * @return  self
     */ 
    public function setCom($com)
    {
        $this->com = $com;

        return $this;
    }

    /**
     * Get the value of noserv
     */ 
    public function getNoserv()
    {
        return $this->noserv;
    }

    /**
     * Set the value of noserv
     *
     * @return  self
     */ 
    public function setNoserv($noserv)
    {
        $this->noserv = $noserv;

        return $this;
    }

    

    

    /**
     * Get the value of noempOriginal
     */ 
    public function getNoempOriginal()
    {
        return $this->noempOriginal;
    }

    /**
     * Set the value of noempOriginal
     *
     * @return  self
     */ 
    public function setNoempOriginal($noempOriginal)
    {
        $this->noempOriginal = $noempOriginal;

        return $this;
    }
}

?>