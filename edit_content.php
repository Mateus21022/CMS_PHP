<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <link rel="stylesheet" href="css/edit_content.css"> 
</head>
<body>
<?php
require 'bancodedados.php';
session_start();
class edit_content extends BancodeDados{


    public function contentShow(){

        $connection = $this->connect();
        $procurar = $connection->prepare ('SELECT*FROM conteudos_usuario WHERE usuario_id = :usuario_id' );
        $procurar -> bindParam ('usuario_id',$_SESSION ['usuario_id']);
        $procurar -> execute ();


        echo "<div class = 'conteudo'><table>";
        echo "<tr><th>ID</th><th>Conteúdo</th></tr>";

        while ($row = $procurar->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['conteudo']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function editContent(){
        $connection = $this->connect();
        if ($_SERVER ['REQUEST_METHOD'] == 'POST'){
        $conteudo_id = $_POST ['conteudo_id'];
        $conteudo_editado = $_POST ['conteudo_editado'];

        $operador = $connection->prepare ('UPDATE conteudos_usuario SET conteudo = :conteudo_editado WHERE id = :conteudo_id');  
        $operador->bindParam (':conteudo_editado', $conteudo_editado);
        $operador->bindParam ('conteudo_id',$conteudo_id);

        if ($operador->execute()){
           echo ("Atualizado");
        }else{
            echo ("Não atualizado");
        }
    }
    }
}

$edit = new edit_content();
$edit->contentShow();
$edit->editContent();
?>

<div class = "Editando">
<form method = "POST">
    <input type = "number" name = "conteudo_id" placeholder="Insira o id do item que deseja alterar" required>
    <input type = "text" name = "conteudo_editado" placeholder="Insira a alteração desejada"required> 
    <button type="submit">Enviar</button>
</form> 
</div>
</body>
</html>