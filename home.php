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
        require_once 'src/Modelo.php';
        
        if(!isset($_SESSION['documento_user'])){            
            $_SESSION['error_login'] = true;
            $_SESSION['error_login_message'] = 'Por favor hacer Login'; 
            header("Location: http://localhost/zinobe/index.php");
        }
        
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="pub/css/styles.css">
    </head>
    <body>
        <a href='cerrarSesion.php'><font color='blue'>Cerrar Sesión</font></a>
        <form id='buscar' name='buscar' action='home.php' method='POST'>                        
            <h2>Bienvenido <?php echo $_SESSION['name_user']; ?></h2>
            <div class="rTableRow"> 
                <div class="rTableHead">Usuario </div>
                <div class="rTableHead">
                    <input type='input' required name='search'>
                </div>            
                <div class="rTableHead">
                    <button>
                        Buscar
                    </button>                        
                </div>                                
            </div>            
        </form>
        <?php
            if(isset($_POST['search'])){
                $customerData = new CustomerData();
                $buscarUsuarios = $customerData->buscarUsuario($_POST);                        
                echo "<br><br><br><table border='2'>";
                if(empty($buscarUsuarios)){
                    echo "<tr><td>No existen resultados</td></tr>";
                }else{
                    foreach($buscarUsuarios as $usuario){
                        echo "<tr>";
                        foreach ($usuario as $key => $user){
                            echo "<td><b>".$key."</b><br> ".$user." </td>";
                        }                    
                        echo "</tr>";
                    }
                }
                
                echo "</table>";
            }
        ?>
    </body>
</html>
