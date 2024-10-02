<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
</head>
<body>

<?php
require 'bancodedados.php';
session_start();

class add_content extends BancodeDados{

    public function contentShow(){
        $connection = $this->connect();
        $procurar = $connection->prepare('SELECT * FROM conteudos_usuario WHERE usuario_id = :usuario_id');
        $procurar->bindParam ('usuario_id', $_SESSION['usuario_id']);
        $procurar->execute();

        echo "<div class = 'conteudo'><table>";
        echo "<tr><th>ID</th><th>Conteúdo</th><th>Data de Criação</th></tr>";

        while ($row = $procurar->fetch (PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['conteudo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['data_criacao']) . "</td>";
            echo "</tr>";
            "</div>";
        }
    }
    

    public function addContent(){
        $connection = $this->connect();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $conteudo_adicionado = $_POST['conteudo_adicionado'];
        }


        $operador = $connection->prepare('INSERT INTO conteudos_usuario (conteudo) VALUES (:conteudo_adicionado)');
        $operador -> bindParam(':conteudo_adicionado',$conteudo_adicionado,);


        if ($operador->execute()) {
            echo ('Conteúdo adicionado com sucesso');
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }else{
            echo ('Erro em adicionar o conteúdo solicitado');
        }

    }
}

$add = new add_content();
$add->contentShow();
$add->addContent();
?>

<div class = 'Adicionando'>
    <form method = "POST">
        <input type = "text" name = "conteudo_adicionado" placeholder = "Insira o conteúdo que deseja adicionar" required>
        <button type ="submit">Enviar</button>
    </form>
</div>
    
</body>
</html>