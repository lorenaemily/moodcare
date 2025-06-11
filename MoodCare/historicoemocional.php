<?php 
    include("conexao.php");
    include("protecao.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>historico emocional</title>
    <?php 
        $stmt = $conexao->prepare("SELECT id_emocao,nome_emocao, DATE_FORMAT(data_de_registro, '%d/%m/%y') AS data FROM emocoes");
        $stmt->execute();
        $emocoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
</head>
<body>
    <h1>Histórico Emocional</h1>
    <ul>
        <?php 
        foreach ($emocoes as $emocao){
            echo '<li>' . htmlspecialchars($emocao['data']) . htmlspecialchars($emocao['id_emocao']) . htmlspecialchars($emocao['nome_emocao']) . '<a href="atualizaremocao.php' . $emocao['id_emocao'] . '">editar</a></li>' . '<a href="excluiremocao.php?id='. urlencode($emocao['id_emocao']) .'"id="Excluir">Excluir</a>';
        }
        

        ?>
    </ul>
</body>
</html>