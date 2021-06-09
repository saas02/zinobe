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
        $paises = $customerData->obtenerPaises();
        
        if(isset($_POST) && !empty($_POST)){            
            $validarCrearDatos = $customerData->insertUser($_POST);
            if(isset($validarCrearDatos['error'])){
                echo "<font color='red'>Error en el campo ".$validarCrearDatos['dato']."</font>";
            }else{
                echo "<a href='index.php'><font color='green'>Registro Exitoso.. Click para hacer login</font></a>";                
            }            
        }elseif(isset($_SESSION['error_formulario'])){
            echo "<font color='red'>".$_SESSION['error_formulario_message']."</font>";
            unset($_SESSION['error_formulario']);
            unset($_SESSION['error_formulario_message']);
        }
        
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="pub/css/styles.css">
    </head>
    <body>        
        <form id='formulario' name='formulario' action='formulario.php' method='POST'>
            <div class="rTable">
                <div class="rTableRow">

                </div>    
            </div>             
            <h2>Formulario</h2> 
            <div class="rTable">                                
                <div class="rTableRow"> 
                    <div class="rTableHead">Nombre </div>
                    <div class="rTableHead">
                        <input type='input' minlength="3" required name='nombre'>
                    </div>                     					
                </div>
                <div class="rTableRow"> 
                    <div class="rTableHead">Documento </div>
                    <div class="rTableHead">
                        <input type='input' required name='documento'>
                    </div>                     					
                </div>                
                <div class="rTableRow"> 
                    <div class="rTableHead">Email </div>
                    <div class="rTableHead">
                        <input type='email' required name='email'>
                    </div>                     					
                </div>                
                <div class="rTableRow"> 
                    <div class="rTableHead">País </div>
                    <div class="rTableHead">
                        <select name="pais" required>
                        <?php
                            foreach($paises as $pais){
                                echo "<option value=".$pais['alpha2Code'].">".$pais['name']."</option>";                                
                            }                            
                        ?>
                        </select>                        
                    </div>                     					
                </div>                
                <div class="rTableRow"> 
                    <div class="rTableHead">Contraseña </div>
                    <div class="rTableHead">
                        <input type='password' required name='password'>
                    </div>                     					
                </div>
                <div class="rTableRow">
                    <div class="rTableHead">Guardar </div>
                    <div class="rTableHead">
                        <button>
                            Guardar
                        </button>                        
                    </div>
                </div>
            </div>    
        </form>        

    </body>
</html>
