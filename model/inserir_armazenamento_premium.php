<?php
// Verifica se os dados do formulário foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega o ID
    $id_usuario = $_POST["id_usuario"];

    require_once 'conexao.php';

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Executa as instruções SQL pra inserir os dados
    for ($i = 1; $i <= 20; $i++) {
        $descricao = $_POST["descricao$i"];
        $email = $_POST["email$i"];
        $senha = $_POST["senha$i"];

        $sql = "INSERT INTO armazenamento (id_usuario, descricao, email_arm, senha_arm) VALUES ('$id_usuario', '$descricao', '$email', '$senha')";

        // Caso de erro pra inserir
        if ($conn->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $conn->error;
        }
    }

    $conn->close();

    // Dando certo o usuário volta pro seu armazenamento
    header("Location: /seapassword/view/armazenamento_premium.php");
    exit();
} else {
    echo "deu ruim";
}
?>