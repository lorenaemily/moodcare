<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastrando</title>
    <link rel="stylesheet" href="styles/styletelalogin.css">
</head>
<body>
    <?php 
        include("conexao.php");
        session_start();

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = trim($_POST["nome"] ?? '');
            $email = trim($_POST["email"] ?? '');
            $senha = $_POST["senha"] ?? '';

            if(empty($email) && empty($senha) && empty($nome)){
                $erro = "preencha seu email, senha ou nome";
            } else if (empty($senha)){
                $erro = "preencha sua senha";
            } else if (empty($email) ){
                $erro = "preencha seu email";
            } else if (empty($nome) ){
                $erro = "preencha seu nome";
            } else {

                $stmtverifica = $conexao->prepare("SELECT * FROM usuario WHERE email_usuario = :email");
                $stmtverifica->bindParam(":email",$email);
                $stmtverifica->execute();

                if($stmtverifica->rowCount() > 0){
                    $erro = "Email já cadastrado.";
                } else {
                
                $senhacriptografada = password_hash($senha, PASSWORD_DEFAULT);

                $stmt = $conexao->prepare("INSERT INTO usuario(nome_usuario, email_usuario, senha_usuario) VALUES (:nome, :email, :senha)");
               
                $stmt->bindParam(":nome",$nome);
                $stmt->bindParam(":email",$email);
                $stmt->bindParam(":senha",$senhacriptografada);
                $stmt->execute();
                
                $id_usuario = $conexao->lastInsertId();
                $stmt = $conexao->prepare("INSERT INTO perfil_usuario (id_usuario_perfil, nome_usuario, meta_usuario, foto_usuario) VALUES         (:id_usuario_perfil, :nome, NULL, NULL)");
                $stmt->bindParam(":id_usuario_perfil", $id_usuario);
                $stmt->bindParam(":nome", $nome);
                $stmt->execute();

                if($stmt->rowCount()=== 1){

                    $_SESSION["id"] = $id_usuario;
                    $_SESSION["nome"] = $nome;
                    $_SESSION["email"] = $email;
                    header("Location: telainicial.php");
                    exit();
                    } else {
                        $erro = "Erro ao cadastrar, tente novamente. ";
                    }
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
                <label>Nome:</label>
                <input type="text" name="nome" id = "nome" required>   
            </p>
            
            <p>
                <label>Email:</label>
                <input type="email" name="email" id = "email" required>   
            </p>

            <p>
                <label>Senha:</label>
                <input type="password" name="senha" id = "senha" required >   
            </p>

            <div id="link-login">
                Já possui uma conta? <a href="telalogin.php"> Faça login</a>
            </div>

            <p class = "entrar">
                <button type="submit" class = "entrar">Cadastrar</button>
            </p>

        </form>
    </div>
    
    
</body>
</html>