<?php  
    include("conexao.php");
    include("protecao.php");

    $id_usuario = $_SESSION["id"] ?? '';
    $stmt = $conexao->prepare("SELECT nome_usuario,meta_usuario,foto_usuario FROM perfil_usuario WHERE id_usuario_perfil = :id_usuario");
    $stmt->bindParam(":id_usuario", $id_usuario);
    $stmt->execute();
    $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD']=== 'POST'){

        $novo_nome = $_POST['nome_usuario'] ?? '';  
        $nova_meta = $_POST['meta'] ?? '';
        $id_usuario = $_SESSION["id"] ?? '';

        if (!empty($_FILES['foto_perfil']["name"])){
            $nova_foto = $_FILES['foto_perfil'];
            $caminho = "images/" . basename($nova_foto['name']);
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $caminho);
        } else {
            $stmt = $conexao->prepare("SELECT foto_usuario FROM perfil_usuario WHERE id_usuario_perfil = :id");
            $stmt->bindParam(':id', $id_usuario);
            $stmt->execute();
            $caminho = $stmt->fetchColumn();
        }

        $update = $conexao->prepare("UPDATE perfil_usuario SET nome_usuario = :novo_nome, meta_usuario = :nova_meta, foto_usuario = :nova_foto WHERE id_usuario_perfil = :id_usuario");
        $update->bindParam(":novo_nome", $novo_nome);
        $update->bindParam(":nova_meta", $nova_meta);
        $update->bindParam(":nova_foto", $caminho);
        $update->bindParam(":id_usuario", $id_usuario);
        if ($update->execute()) {
            header("Location: perfildeusuario.php");
            exit();
        } else {
            echo "<p>Erro ao atualizar perfil.</p>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>atualizar perfil</title>
    <link rel="stylesheet" href="styles/styleatualizarperfil.css">
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

            <?php if($perfil){?>
            <form method="POST" enctype="multipart/form-data">
                <?php if (!empty($perfil['foto_usuario'])): ?>
                    <img src="<?php echo htmlspecialchars($perfil['foto_usuario']); ?>" alt="Foto de perfil" width="100"><br>
                <?php endif; ?>
                <input type="file" id="foto_perfil" name="foto_perfil"><br>

                <input type="text" id="username" name="nome_usuario" value="<?php echo htmlspecialchars($perfil['nome_usuario'] ?? ''); ?>" required><br>

                <label for="nome-meta">Meta:</label><br>
                <div id="meta">
                    <input type="text" name="meta" value="<?php echo htmlspecialchars($perfil['meta_usuario'] ?? ''); ?>"><br>
                </div>

                <button type="submit">Atualizar Perfil</button>

            </form>
            <?php } else { ?>
                <p>Perfil não encontrado.</p>
            <?php } ?>
        </div>

    </div>
</body>
</html>