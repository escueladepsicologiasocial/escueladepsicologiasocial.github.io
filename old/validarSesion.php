<?php
session_start();
//echo "qwerty";
        if(isset($_SESSION['DNIEmpleado'])){
            
            var_dump($_SESSION);
        }else {
            header('Location: ./login.html');
        }
?>