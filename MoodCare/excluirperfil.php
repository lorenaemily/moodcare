<?php 
include("conexao.php");
include("protecao.php");

$id_usuario = $_SESSION["id"] ?? '';
$stmt = $conexao->prepare("DELETE FROM perfil_usuario WHERE id_usuario_perfil = :id_usuario");
$stmt->bindParam(":id_usuario", $id_usuario);
if ($stmt->execute()) {
    session_destroy();
    header("Location: telacadastro.php");
    exit();
} else {
    echo "<p>Erro ao excluir perfil.</p>";
}
?>