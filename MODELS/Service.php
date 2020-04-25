<?php

class Service {
    private $noserv;
    private $service;
    private $ville;

    public static function buildService($array) {
        $service=new Service();

        $service->setNoserv($array["noserv"])
                ->setService($array["service"])
                ->setVille($array["ville"]);

        return $service;
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
     * Get the value of service
     */ 
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @return  self
     */ 
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }
}

?>