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
        
        if(isset($_SESSION['documento_user'])){            
            unset($_SESSION['documento_user']);
            unset($_SESSION['email_user']);
            unset($_SESSION['name_user']);            
        }
        
        header("Location: http://localhost/zinobe/index.php");
?>

