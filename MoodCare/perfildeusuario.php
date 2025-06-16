<?php 
    include("conexao.php");
    include("protecao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil usuário</title>
    <link rel="stylesheet" href="styles/styleperfil.css">
    <?php 
    $id_usuario = $_SESSION["id"] ?? '';
    $stmt = $conexao->prepare("SELECT nome_usuario,meta_usuario,foto_usuario FROM perfil_usuario WHERE id_usuario_perfil = :id_usuario");
    $stmt->bindParam(":id_usuario", $id_usuario);
    $stmt->execute();
    $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

?>
</head>
<body>
    <div class="menulateral">
        <h1> MoodCare </h1>
        <ul>
            <li>
                <a href="http://localhost/MoodCare/telainicial.php">
                    <img src="images/home.png" alt=""><p>Início</p>
            </a>
            </li>
            <li>
                <a href="http://localhost/MoodCare/cadastrodeemocoes.php">
                    <img src="images/Vector.png" alt=""><p>Cadastrar<br>Emoções</p>
                </a>
            </li>
            <li>
                <a href="http://localhost/MoodCare/perfildeusuario.php">
                    <img src="images/perfil.png" alt=""><p>Perfil</p>
                </a>
            </li>
            <li>
                <a href="http://localhost/MoodCare/historicoemocional.php">
                    <img src="images/relogio.png" alt=""><p>Histórico de<br>Emoções</p>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="images/dicas.png" alt=""><p>Dicas</p>
                </a>
            </li>
        </ul>
        <div>
            <img src="images/sair.png" alt="">
            <a href="sair.php">Sair</a>
        </div>
    </div>
    <div class="conteudo">

        <h1>Perfil</h1>

        <div class="perfil-infos">

            <?php if ($perfil): ?>
                <?php if (!empty($perfil['foto_usuario'])): ?>
                    <img src="<?php echo htmlspecialchars($perfil['foto_usuario']); ?>" alt="Foto de perfil" width="100">
                <?php endif; ?>

                <p><?php echo htmlspecialchars($perfil['nome_usuario'] ?? ''); ?></p>
                <p>Metas:</p>
                
                <div id="meta">
                    <p placeholder="Escreva sua meta"><?php echo htmlspecialchars($perfil['meta_usuario'] ?? ''); ?></p>
                </div>

                <a href="atualizarperfil.php?" id="Editar">Editar</a>
                <a href="excluirperfil.php?" id="Excluir">Excluir</a>
            <?php else: ?>
                <p>Perfil não encontrado.</p>
            <?php endif; ?>

        </div>

    </div>
    

</body>
</html>
