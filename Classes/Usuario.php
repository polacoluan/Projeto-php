<?php

class Usuario {
    private $idusuario;
    private $name;
    private $user;
    private $password;
    private $dt_cadastro;

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

    public function getUser(){
        
        return $this->user;
    }

    public function setUser($value){

        $this->user = $value;
    }  

    public function setPassword($value){
 
        $this->password = $value;
    } 
    
    public function getPassword(){

        return $this->password;
    }

    public function setDtCadastro($value){
 
        $this->dt_cadastro = $value;
    } 
    
    public function getDtCadastro(){

        return $this->dt_cadastro;
    }

    public function loadById($id){

        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM projeto.tb_usuarios WHERE id = :ID", [":ID" => $id]);

        if(isset($resultSql[0])){

            $this->setData( $resultSql[0]);
        }
    }

    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM projeto.tb_usuarios");
    }

    public static function search($user){

        $sql = new Sql();

        return $sql->select("SELECT * FROM projeto.tb_usuarios WHERE user LIKE :SEARCH", [':SEARCH'=>"%".$user."%"]);
    }

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL projeto.tb_usuarios_insert(:USER, :PASSWORD)", [
            ":USER" => $this->getUser(),
            ":PASSWORD" => $this->getPassword(),
        ]);

        if(count($results[0]) > 0){

            $this->setData($results[0]);

        }else{

            throw new Exception("Falha ao inserir os dados");
        }
    }

    public function update($user, $password){

        $this->setUser($user);
        $this->setPassword($password);

        $sql = new Sql();

        $sql->consulta("UPDATE projeto.tb_usuarios SET user = :USER, password = :PASSWORD WHERE id = :ID", [
            ":USER" => $this->getUser(),
             ":PASSWORD" => $this->getPassword(),
              ":ID" => $this->getIdusuario()]);
    }

    public function __construct($user = "", $password = ""){

        $this->setUser($user);
        $this->setPassword($password);
    }

    public function login($user, $password){
        
        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM projeto.tb_usuarios WHERE user = :USER AND password = :PASSWORD", [":USER" => $user, ":PASSWORD" => $password]);

        if(isset($resultSql[0])){

            $this->setData( $resultSql[0]);

        }else{

            throw new Exception("Login e/ou senha inválidos");
        }
    }

    public function setData($data){

        $this->setIdusuario($data["id"]);
        $this->setName($data["name"]);
        $this->setUser($data["user"]);
        $this->setPassword($data["password"]);
        $this->setDtCadastro($data["dt_cadastro"]);
    }

    public function __toString(){

        return json_encode([
            "id" => $this->getIdusuario(),
            "name" => $this->getName(),
            "user" => $this->getUser(),
            "password" => $this->getPassword(),
            "dt_cadastro" => $this->getDtCadastro(),
        ]);
    }


}


?>