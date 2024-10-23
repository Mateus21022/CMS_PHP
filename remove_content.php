<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover</title>
    <link rel="stylesheet" href="css/remove_content.css"> 
</head>
<body>

<?php
require 'bancodedados.php';
session_start();

class remove_content extends BancodeDados {

    public function contentShow(){

        $connection = $this->connect();
        $procurar = $connection->prepare('SELECT * FROM conteudos_usuario WHERE usuario_id = :usuario_id');
        $procurar->bindParam('usuario_id', $_SESSION['usuario_id']);
        $procurar->execute();

        echo "<div class='conteudo'><table>";
        echo "<tr><th>ID</th><th>Conteúdo</th><th>Data de Criação</th></tr>";

        while ($row = $procurar->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['conteudo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['data_criacao']) . "</td>";
            echo "</tr>";
        }

        echo "</table></div>";
    }


    public function removeContent(){
        $connection = $this->connect();
        
        if (!empty($_POST['id']) && isset($_SESSION['usuario_id'])){
 
         $id = $_POST['id'];
         $usuario_id = $_SESSION['usuario_id'];
 
 
         $operador = $connection->prepare ('DELETE FROM conteudos_usuario WHERE id = :id');
         $operador->bindParam (':id',$id);
 
         if ($operador->execute()){
             echo ("Conteúdo Removido com Sucesso");
             header ( "Location". $_SERVER['PHP_SELF']);
             exit();
         }else{
             echo ("Erro na remoção");
         }
       }
     }
 }

$remove = new remove_content();
$remove->contentShow();
$remove->removeContent();
?>
<div class = "Removendo">
<form method = "POST">
    <input type = "number" name = "id" placeholder="Insira o id do item que deseja remover" required> 
    <button type="submit">Enviar</button>
</form> 
</div>
</body>
</html>