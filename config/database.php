<?php

class Database {

    private $host="localhost";
    private $db="ips_almavida";
    private $user="root";
    private $pass="";

    public function conectar(){

        try{

            $pdo=new PDO(
                "mysql:host=".$this->host.";dbname=".$this->db,
                $this->user,
                $this->pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $pdo;

        }catch(PDOException $e){

            echo "Error ".$e->getMessage();

        }

    }

}