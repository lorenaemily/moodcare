<?php 
    include("conexao.php");
    include("protecao.php");

    $emocao_id = $_GET['id'] ?? '';
    $stmt = $conexao->prepare("SELECT id_emocao, nome_emocao, registro_emocional FROM emocoes WHERE id_emocao = :id_emocao");
    $stmt->bindParam(":id_emocao", $emocao_id);
    
?>