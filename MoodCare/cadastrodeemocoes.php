<?php 
    include("conexao.php");
    session_start();
    $mensagem = "";

    $emocao = $_POST['nome_emocao'] ?? '';
    $registro = $_POST['registro'] ?? '';
    $id_usuario = $_SESSION['id'] ?? '';
    $stmt = $conexao->prepare("INSERT INTO emocoes (nome_emocao, registro_emocional, id_usuario) VALUES (:nome_emocao, :registro_emocional,:id_usuario)");
    $stmt->bindParam(":registro_emocional", $registro);
    $stmt->bindParam(":nome_emocao", $emocao);
    $stmt->bindParam(":id_usuario", $id_usuario);

    if ($stmt->execute()) {
        $mensagem="Emoção cadastrada com sucesso!";
    } else {
        $mensagem= "Erro ao cadastrar emoção.";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/stylecadastroemocoes.css">
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
        <h1>Cadastrar Emoções</h1>
        <div id="selecionando-emocoes">
            <div id="emocoes">
                <p>Como você está se sentindo ?</p>
                    <form action="#" method="POST">
                        <input type="radio" id="alegria" name="nome_emocao" value="alegria">
                        <label for="alegria">Alegria</label>
                        <input type="radio" id="tristeza" name="nome_emocao" value="tristeza">
                        <label for="tristeza">tristeza</label>
                        <input type="radio" id="raiva" name="nome_emocao" value="raiva">
                        <label for="raiva">Raiva</label>
            </div>

            <div id="registro-emocional">
                <p>Descrição:</p>
                <input type="text" id="registro" name="registro" >
                <input type="submit">
                </form>
            </div>

        <?php if (!empty($mensagem)) { ?>
            <p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
        <?php } ?>

        </div>
    </div>
</body>
</html>
