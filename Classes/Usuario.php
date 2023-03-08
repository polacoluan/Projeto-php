<?php

class Usuario {
    private $idusuario;
    private $name;

    public function getIdusuario(){
        
        return $this->idusuario;
    }

    public function setIdusuario($value){

        $this->idusuario = $value;
    } 

    public function getName(){
        
        return $this->name;
    }

    public function setName($value){

        $this->name = $value;
    }   

    public function loadById($id){

        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM projeto.tb_usuarios WHERE id = :ID", array(
           ":ID" => $id 
        ));

        if(isset($resultSql[0])){

            $row = $resultSql[0];

            $this->setIdusuario($row["id"]);
            $this->setName($row["name"]);
        }
    }

    public function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM projeto.tb_usuarios");
    }

    public function __toString(){
        
        return json_encode(array(
            "id" => $this->getIdusuario(),
            "name" => $this->getName()
        ));
    }


}


?>