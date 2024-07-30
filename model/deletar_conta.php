<?php
// Inicia sessão
session_start();

// Verifica se foi tudo enviado no formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_usuario"]) && $_POST["id_usuario"] == $_SESSION["id_usuario"]) {
        $id_usuario = $_POST["id_usuario"];

        require_once 'conexao.php';

        // Inicia transação
        $conn->begin_transaction();

        try {
            // Deletar armazenamento
            $sql_armazenamento = "DELETE FROM armazenamento WHERE id_usuario = ?";
            $stmt_armazenamento = $conn->prepare($sql_armazenamento);
            $stmt_armazenamento->bind_param("i", $id_usuario);
            if (!$stmt_armazenamento->execute()) {
                throw new Exception("Erro ao deletar armazenamento.");
            }
            $stmt_armazenamento->close();

            // Deletar pagamento
            $sql_pagamento = "DELETE FROM pagamento WHERE id_usuario = ?";
            $stmt_pagamento = $conn->prepare($sql_pagamento);
            $stmt_pagamento->bind_param("i", $id_usuario);
            if (!$stmt_pagamento->execute()) {
                throw new Exception("Erro ao deletar pagamento.");
            }
            $stmt_pagamento->close();

            // Deletar usuário
            $sql_usuario = "DELETE FROM usuario WHERE id_usuario = ?";
            $stmt_usuario = $conn->prepare($sql_usuario);
            $stmt_usuario->bind_param("i", $id_usuario);
            if (!$stmt_usuario->execute()) {
                throw new Exception("Erro ao deletar usuário.");
            }
            $stmt_usuario->close();

            // Commit transação
            $conn->commit();

            // Destruir a sessão e redirecionar pra a página inicial
            session_destroy();
            header("Location: /seapassword/view/index.php");
            exit();
        } catch (Exception $e) {
            // Rollback transação em caso de erro
            $conn->rollback();
            echo $e->getMessage();
        }

        $conn->close();
    } else {
        echo "Ação não autorizada.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
