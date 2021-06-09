<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
date_default_timezone_set('America/Bogota');
require_once "Conexion.php";

class Modelo extends Conexion {

    public function __construct() {
        parent::__construct();
    }    

    public function insertUser($data) {
                
        $query = $this->_db->query('INSERT INTO usuarios (nombre, documento, email, pais, password) VALUES ("' . $data['nombre'] . '", "' . $data['documento'] . '", "' . $data['email'] . '", "' . $data['pais'] . '", "' . $data['password'] . '")');
        
        if ($query === TRUE) {
            $result['status'] = 1;
            $result['message'] = 'success';
        } else {
            $result['error'] = 1;            
            $result['message'] = $this->_db->error;            
        }
        
        return $result;
    }
    
    public function validarUser($nombre, $password = false) {
    
        $query = "SELECT * FROM usuarios 
        WHERE (documento = '".$nombre."' or email = '".$nombre."')";
        
        if($password){
            $query .= " AND password = '".$password."' ";
        }
        
        $result = $this->_db->query($query);
    
        try{
            $dataUser = $result->fetch_all(MYSQLI_ASSOC);
        } catch (\ErrorException $e){
            $dataUser['error'] = 'Usuario ya registrado';
        }
                     
        return $dataUser;
    }
    
    
    

}