<?php
require 'conexao.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $sql = "SELECT id, nome FROM usuarios WHERE email= '$email' LIMIT 1";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        $idUsuario = $user['id'];
        $nome = $user['nome'];

        $novaSenha = substr(md5(uniqid(rand(), true)), 0, 8);

        $sqlUpdate = "UPDATE usuarios SET senha = '$novaSenha' WHERE id = $idUsuario";

        if ($conn->query($sqlUpdate)) {
            $mail = new PHPMailer(true);
            try { 
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'gustavosantosgguu@gmail.com';
                $mail->Password = 'lwwf rmdb ogoc pzai';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('gustavosantosgguu@gmail.com', 'Suporte - Sistema');
                $mail->addAddress($email, $nome);

                $mail->isHTML(true);
                $mail->Subject = 'Recuperar senha';
                $mail->Body = "Olá <b>$nome</b>,<br><br>
                               Sua nova senha é: <b>$novaSenha</b><br><br>
                               Recomendamos que altere a senha após o login.";
                $mail->AltBody = "Olá $nome,\n\nSua nova senha é: $novaSenha\n\n";

                $mail->send();
                echo "Uma nova senha foi enviada para o seu Gmail.";
            } catch (Exception $e) {
                echo "ERRO ao enviar Gmail: {$mail->ErrorInfo}";
            }
        } else {
            echo "ERRO ao atualizar a senha no banco.";
        }
    } else {
        echo "Email não encontrado.";
    }
}
?>
