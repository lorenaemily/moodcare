<?php 
    try {
        $usuario = "root";
        $senha = "lorena123";
        $banco = "MoodCare";
        $conexao = new PDO("mysql:host=localhost;dbname=$banco;charset=utf8mb4",
        "$usuario", "$senha",[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>
            PDO::FETCH_ASSOC
        ]);
        } catch (PDOException $erro) {
        echo "Erro na conexão: " . $erro->getMessage();
    };
?>