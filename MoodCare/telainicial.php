<?php 
    include("protecao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial MoodCare</title>
    <link rel="stylesheet" href="styles/styletelainicial.css">
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
        <div id="recepcao">
            <p>Olá, Username !</p>
            <img src="images/avatar.png" alt="">
        </div>
        <section>
            <div class="cards">
                <img src="images/Vector.png" alt="">
                <p>Cadastrar
                    Emoções</p>
            </div>
             <div class="cards">
                <img src="images/perfil.png" alt="">
                <p>Perfil</p>
            </div>
             <div class="cards">
                <img src="images/relogio.png" alt="">
                <p>Histórico de 
                    Emoções</p>
            </div>
             <div class="cards">
                <img src="images/dicas.png" alt="">
                <p>Dicas</p>
            </div>
        </section>
    </div>
    
</body>
</html>