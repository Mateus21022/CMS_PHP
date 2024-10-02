<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="home.css"> 
</head>
<body>
    <div class="login">
        <h1>CMS</h1>

        <form action="" method="POST">
            <input type="text" id="usuario" name="usuario" placeholder="Insira seu usuario" required>
            <input type="password" id="senha" name="senha" placeholder="Insira sua senha" required>
            <button type="submit">Enviar</button>
        </form>
    </div>

<?php

require 'bancodedados.php';
session_start();

class Home extends BancodeDados {
    private $usuario;
    private $senha;

    public function __construct($usuario, $senha) {
        $this->usuario = htmlspecialchars($usuario);
        $this->senha = htmlspecialchars($senha);
    }
    
    public function validar() {

            $connection = $this->connect();
            $procurar = "SELECT id FROM usuarios WHERE usuario = :usuario AND senha = :senha";
            $prepararconsulta = $connection->prepare($procurar);
            
            $prepararconsulta->bindParam(':usuario', $this->usuario);
            $prepararconsulta->bindParam(':senha', $this->senha);    
            $prepararconsulta->execute();
            $id = $prepararconsulta->fetch(PDO::FETCH_ASSOC);
        
            if ($prepararconsulta->rowCount() > 0) {
                $_SESSION ['usuario_id'] = $id['id'];
                header('Location: content.php');
                exit();
            } else {
                echo "Usuário ou senha incorretos";
            }
        }       
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $home = new Home($_POST['usuario'], $_POST['senha']);
    $home->validar();
}
?>
    
</body>
</html>
