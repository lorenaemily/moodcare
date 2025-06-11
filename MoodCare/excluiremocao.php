<?php 
    include("conexao.php");
    include("protecao.php");

    $emocao_id = $_GET['id'] ?? '';
    $stmt = $conexao->prepare("DELETE FROM emocoes WHERE id_emocao = :emocao_id");
    $stmt->bindParam(":emocao_id", $emocao_id);
    if ($stmt->execute()) {
        header("Location: historicoemocional.php");
        exit();
    } else {
        echo "<p>Erro ao excluir histórico emocional.</p>";
    }

?>