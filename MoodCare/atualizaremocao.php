<?php 
    include("conexao.php");
    include("protecao.php");

    $emocao_id = $_GET['id'] ?? '';
    $stmt = $conexao->prepare("SELECT id_emocao, nome_emocao, registro_emocional FROM emocoes WHERE id_emocao = :id_emocao");
    $stmt->bindParam(":id_emocao", $emocao_id);
    $stmt->execute();
    $emocao = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD']=== 'POST' ){

        $novo_nome = $_POST['nome_emocao'] ?? '';
        $novo_registro = $_POST['registro_emocional'] ?? '';

        $update = $conexao->prepare("UPDATE emocoes SET nome_emocao = :nome_emocao, registro_emocional = :registro_emocional WHERE id_emocao = :id_emocao");
        $update->bindParam(":nome_emocao", $novo_nome);
        $update->bindParam(":registro_emocional", $novo_registro);
        $update->bindParam(":id_emocao", $emocao_id);

        if($update->execute()){
            header("Location: historicoemocional.php");
            exit();
        } else {
            echo "<p>Erro ao atualizar emoção.</p>";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($emocao){?>
    <form method="POST">
        <input type="hidden" name="id_emocao" value="<?php echo htmlspecialchars($emocao['id_emocao']); ?>">
        <label for="nome_emocao">Nome da Emoção:</label><br>
        <input type="radio" id="alegria" name="nome_emocao" value="alegria"
            <?php if ($emocao['nome_emocao'] === 'alegria') echo 'checked'; ?> required>
        <label for="alegria">Alegria</label>
        <input type="radio" id="tristeza" name="nome_emocao" value="tristeza"
            <?php if ($emocao['nome_emocao'] === 'tristeza') echo 'checked'; ?> required>
        <label for="tristeza">tristeza</label>
        <input type="radio" id="raiva" name="nome_emocao" value="raiva"
            <?php if ($emocao['nome_emocao'] === 'raiva') echo 'checked'; ?> required>
        <label for="raiva">Raiva</label>
        
        <label for="registro_emocional">Registro Emocional:</label><br>
        <textarea id="registro_emocional" name="registro_emocional" required><?php echo htmlspecialchars($emocao['registro_emocional']); ?></textarea><br>
        <button type="submit">Atualizar Emoção</button>
    </form>

    <?php }else{?>
        <p>Emoção não encontrada</p>
    <?php }?>
</body>
</html>