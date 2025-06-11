<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logando</title>
    <link rel="stylesheet" href="styles/styletelalogin.css">
</head>
<body>
    <?php 
        include("conexao.php");
        session_start();

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $email =trim($_POST["email"] ?? '');
            $senha = $_POST["senha"] ?? '';

            if(empty($email) && empty($senha)){
                $erro = "preencha seu email e senha";
            } else if (empty($senha)){
                $erro = "preencha sua senha";
            } else if (empty($email) ){
                $erro = "preencha seu email";
            } else {
                
               $stmt = $conexao->prepare("SELECT * FROM usuario WHERE email_usuario = :email");

               $stmt->bindParam(":email",$email);
               $stmt->execute();

              if($stmt->rowCount()=== 1){

                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($senha,$usuario["senha_usuario"])) {

                    $_SESSION["id"] = $usuario["id_usuario"];
                    $_SESSION["email"] = $usuario["email_usuario"];
                    header("Location: telainicial.php");
                    exit();

                } else {
                    $erro = "senha incorreta.";

                }
            } else {
                    $erro = "Email não encontrado.";
              }
            }
        }
    ?>    
    <img src="images/Post do Instagram Aprenda Lidar com Suas Emoções.1.png" id="banner"></img>

    <div id = "ladodireito">
        <form action="" method="POST" id="formulario">
            <img src="images/logo_moodcare (1).png" alt="" id="logo">
            <h1>MoodCare</h1>

            <?php if(isset($erro)): ?>
            <p id="mensagem-erro"><?php echo $erro; ?></p>
            <?php endif; ?>
            <p>
                <label>Email:</label>
                <input type="email" name="email" id = "email" required>   
            </p>

            <p>
                <label>Senha:</label>
                <input type="password" name="senha" id = "senha" required>   
            </p>

            <div id="link-login">
            ainda não possui uma conta ? <a href="telacadastro.php"> Faça o seu cadastro</a>
            </div>

            <p class = "entrar">
                <button type="submit" class = "entrar">Entrar</button>
            </p>

        </form>
    </div>
    
    
</body>
</html>