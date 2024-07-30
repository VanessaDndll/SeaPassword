<?php
// Inicia a sessão
session_start();

require_once __DIR__ .'/../model/conexao.php';

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} 

// Verifica se foi tudo enviado no formulário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["senha"])) {
    
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql_verificar_login = "SELECT * FROM usuario WHERE email_usuario = ? AND senha = ?";
    $stmt = $conn->prepare($sql_verificar_login); //Preparação a consulta, protege contra injeção SQL
    $stmt->bind_param("ss", $email, $senha); // Põe os parametros email e senha na consulta, o ss indica que os valores são strings
    $stmt->execute(); // Execulta a consulta
    $result_verificar_login = $stmt->get_result(); // Pega o conjunto de resultados da consulta
    
    if ($result_verificar_login->num_rows > 0) {
        $row = $result_verificar_login->fetch_assoc();
        $id_usuario = $row["id_usuario"];

        $sql_verificar_plano = "SELECT data_pagamento, data_pagamento_expiracao, id_plano 
        FROM pagamento WHERE id_usuario = ?";
        $stmt_plano = $conn->prepare($sql_verificar_plano); //Preparação a consulta, protege contra injeção SQL
        $stmt_plano->bind_param("i", $id_usuario); // Põe o parametro id usuario na consulta, o i indica que o valore é inteiro
        $stmt_plano->execute(); // Execulta a consulta
        $result_verificar_plano = $stmt_plano->get_result(); // Pega o resultado da consulta

        // Verifica se o plano não tá expirado
        if ($result_verificar_plano->num_rows > 0) {
            $row_plano = $result_verificar_plano->fetch_assoc();
            $data_pagamento = strtotime($row_plano["data_pagamento"]);
            $data_expiracao = strtotime($row_plano["data_pagamento_expiracao"]);
            $data_atual = time();
            $id_plano = $row_plano["id_plano"];

            // Independente do resultado do plano, vai ser mandado pro seu perfil 
            if ($data_expiracao >= $data_atual) {
                $_SESSION["id_usuario"] = $id_usuario;
                $_SESSION["id_plano"] = $id_plano;

                header("Location: /seapassword/view/meu_perfil.php");
                exit();
                  
            } else {
                header("Location: /seapassword/view/meu_perfil.php");
                exit();
            }
        } else {
            header("Location: /seapassword/view/meu_perfil.php");
            exit();
        }
    } else {
        echo "Credenciais inválidas. Por favor, tente novamente.";
    }
} else {
    header("Location: /seapassword/view/perfil_entrar.php");
    exit();
}
?>
