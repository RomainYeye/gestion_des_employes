<?php

interface ServiceInterface {

    public function __construct(DAOInterface $DAO);

    public function selectAll() : array ;

    public function add(object $choice) : void;

    public function edit(object $choice) : void;

    public function dl(int $choice) : void;

    public function exportDb();

}