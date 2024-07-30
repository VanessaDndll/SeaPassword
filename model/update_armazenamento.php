<?php
// Verifica se os dados do formulário foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o ID do usuário
    $id_usuario = $_POST["id_usuario"];

    require_once 'conexao.php';

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtem a ID do plano do X usuário
    $sql_plano = "SELECT id_plano FROM pagamento WHERE id_usuario = $id_usuario";
    $result_plano = $conn->query($sql_plano);
    if ($result_plano->num_rows > 0) {
        $row_plano = $result_plano->fetch_assoc();
        $id_plano = $row_plano['id_plano'];
    } else {
        echo "Plano do usuário não encontrado.";
        exit();
    }

    // Consulta pra pegar todos os registros do usuário
    $sql = "SELECT id_arm FROM armazenamento WHERE id_usuario = $id_usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $i = 1;
        while($row = $result->fetch_assoc()) {
            $id_armazenamento = $_POST["id_arm$i"];
            $descricao = $_POST["descricao$i"];
            $email = $_POST["email$i"];
            $senha = $_POST["senha$i"];

            // Atualiza os dados no banco de dados
            $update_sql = "UPDATE armazenamento SET descricao = '$descricao', email_arm = '$email', senha_arm = '$senha' WHERE id_arm = $id_armazenamento";

            if ($conn->query($update_sql) === FALSE) {
                echo "Erro ao atualizar dados: " . $conn->error;
            }

            $i++;
        }
    }

    $conn->close();

    // Redireciona pra página de armazenamento do usuário
        switch ($id_plano) {
            case 1:
                header("Location: /seapassword/view/armazenamento_essencial.php");
                break;
            case 2:
                header("Location: /seapassword/view/armazenamento_plus.php");
                break;
            case 3:
                header("Location: /seapassword/view/armazenamento_premium.php");
                break;
            default:
                echo "Plano inválido.";
                exit;
        }
        exit();
} else {
echo "Método de requisição inválido.";
}
?>
