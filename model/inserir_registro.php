<?php
    require_once 'conexao.php';

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    
    // Obtem as informações do formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

    // Verifica se o e-mail já tá em uso
    $sql_verifica_email = "SELECT * FROM usuario WHERE email_usuario = '$email'";
    $result_verifica_email = $conn->query($sql_verifica_email);
    
    // Se o resultado da consulta for maior que 0, o email já foi resistrado
    if ($result_verifica_email->num_rows > 0) {
        echo "Este e-mail já está em uso.";
    } else {
        
        // Insere as informações do usuário no banco
        $sql_inserir_usuario = "INSERT INTO usuario (nome, email_usuario, senha) VALUES ('$nome', '$email', '$senha')";
        
        // Se der certo, vai ser iniciada a sessão pro X usuário
        if ($conn->query($sql_inserir_usuario) === TRUE) {

            $id_usuario = $conn->insert_id;

            session_start();
            
            $_SESSION["id_usuario"] = $id_usuario;
            
            header("Location: /seapassword/view/planos.php");
            exit();
        } else {
            echo "Erro ao registrar usuário: " . $conn->error;
        }
    }
    }
   
?>