<?php
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recuperar senha</title>
</head>
<body>
    <h2>recuperar senha</h2>
    <form action="processa_recuperacao.php" method="POST">
        <label>Email cadastrado</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit">Recuperar</button>
    </form>
    
</body>
</html>