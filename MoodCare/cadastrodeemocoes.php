<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST">
        <input type="radio" id="alegria" name="nome_emocao" value="alegria">
        <label for="alegria">Alegria</label>
        <input type="radio" id="tristeza" name="nome_emocao" value="tristeza">
        <label for="tristeza">tristeza</label>
        <input type="radio" id="raiva" name="nome_emocao" value="raiva">
        <label for="raiva">Raiva</label>
        <input type="text" id="registro" name="registro" >
        <input type="submit">

    </form>
</body>
</html>


<?php 
    include("conexao.php");
    session_start();
    $emocao = $_POST['nome_emocao'] ?? '';
    $registro = $_POST['registro'] ?? '';
    $id_usuario = $_SESSION['id'] ?? '';
    $stmt = $conexao->prepare("INSERT INTO emocoes (nome_emocao, registro_emocional, id_usuario) VALUES (:nome_emocao, :registro_emocional,:id_usuario)");
    $stmt->bindParam(":registro_emocional", $registro);
    $stmt->bindParam(":nome_emocao", $emocao);
    $stmt->bindParam(":id_usuario", $id_usuario);
    if ($stmt->execute()) {
        echo "Emoção cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar emoção.";
    }
?>