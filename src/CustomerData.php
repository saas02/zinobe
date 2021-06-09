<?php

require_once 'Modelo.php';

class CustomerData {
    
    public function validarUsuario($datos){
        $modelo = new modelo();
        
        $validarUsuario = $modelo->validarUser($datos['nombre']);
        
        if(empty($validarUsuario)){
            header("Location: formulario.php");
        }else{
            
            $validarUsuario = $modelo->validarUser($datos['nombre'], $datos['password']);            
        
            if(empty($validarUsuario)){
                $_SESSION['error_login'] = true;
                $_SESSION['error_login_message'] = 'Error en credenciales';                
                header("Location: index.php");
            }else{                
                
                $_SESSION['documento_user'] = $validarUsuario[0]['documento'];
                $_SESSION['name_user'] = $validarUsuario[0]['nombre'];
                $_SESSION['email_user'] = $validarUsuario[0]['email'];
                header("Location: home.php");
            }
        }                
    }        
    
    public function insertUser($post) {
        $validarCrearDatos = $this->validarCrearDatos($post);
        if(isset($validarCrearDatos['error'])){
            return $validarCrearDatos;
        }else{
            $modelo = new modelo();            
            $validarUsuario = $modelo->validarUser($post['nombre'], $post['password']);            
            if(empty($validarUsuario)){
                return $modelo->insertUser($post);
            }else{
                $_SESSION['error_login'] = true;
                $_SESSION['error_login_message'] = 'Usuario Ya Existe';                
                header("Location: index.php");
            }
            
            return $validarUsuario;
        }
    }
    
    public function validarCrearDatos($post){
        $datosObligatorios = [
            "nombre",
            "documento",
            "email",
            "pais",
            "password"
        ];
        
        $resultado = [];
        
        if(count($post) === count($datosObligatorios)){
            foreach($post as $key => $dato){                
                if(!in_array($key, $datosObligatorios)){
                    $resultado['dato'] = $key;
                    $resultado['error'] = 1;                    
                }
            }
        }else{
            $resultado['error'] = 1;
        }
        
        return $resultado;
    }
    
    public function buscarUsuario($post){
        
        $url = 'http://www.mocky.io/v2/5d9f39263000005d005246ae?mocky-delay=1s';
        
        $usuarios = $this->validateJson($this->createCurl($url));
        $usuario = [];
        
        if(!empty($usuarios) && is_array($usuarios)){
            foreach($usuarios as $user){
                foreach($user as $data){
                    if(strpos(strtolower($data['email']), strtolower($post['search'])) !== false || strpos(strtolower($data['first_name']), strtolower($post['search'])) !== false){
                        $usuario[] = $data;
                    }                
                }            
            }
        }                
        
        return $usuario;
    }

    public function obtenerPaises() {
        $url = 'https://restcountries.eu/rest/v2/all';
        $paises = $this->createCurl($url);

        return $this->validateJson($paises);
    }

    public function createCurl($url = 'nul') {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function validateJson($json) {
        
        $result = json_decode($json, true);

        switch (json_last_error()) {            
            case JSON_ERROR_DEPTH:
                $result = ' - Maximum stack depth exceeded';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $result = ' - Underflow or the modes mismatch';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $result = ' - Unexpected control character found';
                break;
            case JSON_ERROR_SYNTAX:
                $result = ' - Syntax error, malformed JSON';
                break;
            case JSON_ERROR_UTF8:
                $result = ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;            
        }
        
        return $result;
    }

}
