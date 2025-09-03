<?php
include 'conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql = "SELECT id, nome, senha FROM usuarios WHERE usuario ='$usuario'LIMIT 1";
    $res = $conn->query($sql);

    if ($res->num_rows > 0){
        $user = $res->fetch_assoc();

        if (passwordd_verify($senha, $user['senha'])){
            echo"Login realizado com sucesso! Bem-vindo" . $user['nome'];
        }else{
            echo"SENHA INCORRETA!";
        }
    }else{
        echo"Usuario nao encontrado!";
    }


    $conn->close();

}


?>