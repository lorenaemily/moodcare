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
    <link rel="stylesheet" href="styles/stylehistorico.css">
    <?php 
        $stmt = $conexao->prepare("SELECT id_emocao,nome_emocao, DATE_FORMAT(data_de_registro, '%d/%m/%y') AS data FROM emocoes WHERE id_usuario = :id_usuario ORDER BY data_de_registro DESC");
        $stmt->bindParam(":id_usuario", $_SESSION['id']);
        $stmt->execute();
        $emocoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <div id="conteudo">
        <h1>Histórico Emocional</h1>
        <ul>
            <?php 
                foreach ($emocoes as $emocao){
                    echo '<li id="lista-emocoes">' . 
                    '<p style="margin:5px;">'.
                        htmlspecialchars($emocao['nome_emocao']) .
                    '</p>'.
                    '<p style="margin:5px; margin-left:500px;">'.  
                        htmlspecialchars($emocao['data']) .
                    '</p>'. 
                    '<a href="atualizaremocao.php?id='. urlencode($emocao['id_emocao']) .'"id="Editar">Editar</a>' . 
                    '<a href="excluiremocao.php?id='. urlencode($emocao['id_emocao']) .'"id="Excluir">Excluir</a>';
                    echo '</li>';
                }
            ?>
        </ul>
    </div>
</body>
</html>