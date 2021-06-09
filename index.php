<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
        session_start();
        ini_set("xdebug.var_display_max_children", -1);
        ini_set("xdebug.var_display_max_data", -1);
        ini_set("xdebug.var_display_max_depth", -1); 
        
        require_once 'src/CustomerData.php';     
        $customerData = new CustomerData();        
        
        if(isset($_POST['nombre']) && !empty($_POST['nombre'])){
            $validarUsuario = $customerData->validarUsuario($_POST);
        }elseif(isset($_SESSION['error_login'])){
            echo "<font color='red'>".$_SESSION['error_login_message']."</font>";
            unset($_SESSION['error_login']);
            unset($_SESSION['error_login_message']);
        }elseif(isset($_SESSION['documento_user'])){
            header("Location: home.php");
        }
        
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="pub/css/styles.css">
    </head>
    <body>
        <form id='login' name='login' action='index.php' method='POST'>                        
            <h2>Login</h2> 
            <div class="rTable">                                
                <div class="rTableRow"> 
                    <div class="rTableHead">Usuario </div>
                    <div class="rTableHead">
                        <input type='input' minlength="3" required name='nombre'>
                    </div>                     					
                </div>                
                <div class="rTableRow"> 
                    <div class="rTableHead">Contraseña </div>
                    <div class="rTableHead">
                        <input type='password' minlength="6" required name='password'>
                    </div>                     					
                </div>
                <div class="rTableRow">
                    <div class="rTableHead">Login </div>
                    <div class="rTableHead">
                        <input type='submit' name='login' value='Login'>
                    </div>
                </div>
            </div>    
        </form>        
    </body>
</html>
