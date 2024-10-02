<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="content.css"> 
    <title>Conteúdos</title>
</head>
<body>
<?php
require 'bancodedados.php';
session_start();

class Content extends BancodeDados {

    public function showcontent() {
        $connection = $this->connect();

        $consulta = $connection->prepare('SELECT * FROM conteudos_usuario WHERE usuario_id = :usuario_id');
        $consulta->bindParam(":usuario_id", $_SESSION['usuario_id']);
        $consulta->execute();

      
        echo "<div class = 'conteudo'><table>";
        echo "<tr><th>ID</th><th>Conteúdo</th><th>Data de Criação</th></tr>";

     
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['conteudo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['data_criacao']) . "</td>";
            echo "</tr>";
            "</div>";
        }
        echo "</table>";
         
        echo "<div class= 'Caixa'>";
        echo "<form method = 'POST' action ='add_content.php'>";
        echo "<div class='Adicionar'><button type='submit' id='addButton'>Adicionar Conteúdo</button></div>";
        echo "</form>";

        echo "<div class='Remover'><button type='submit' id='RemoveButton'>Remover Conteúdo</button></div>";

        echo "<form method = 'POST' action ='edit_content.php'>";
        echo "<div class='Alterar'><button type='submit' id='EditButton'>Alterar Conteúdo</button></div>";
        echo "</form>";
        echo "</div>";
    }


   /*/ public function editcontent(){
        $connection = $this->connect();
    }/*/


}
$content = new Content();
$content->showcontent();

?>
</body>
</html>
