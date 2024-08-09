<?php

    $servidor="localhost";
    $usuario="root";
    $senha="";
    $dbname="trabalho_web";

        $conexao=mysqli_connect($servidor, $usuario, $senha, $dbname);
        if(!$conexao) {
            die("Ocorreu um erro ao conectar: ".mysqli_connect_error());
        }
    
?>