
<?php
require_once 'conexao.php';
// print_r($_POST);

// Verifica se os dados do cartão de crédito foram enviados
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_usuario"]) && isset($_POST["id_plano"]) 
&& isset($_POST["numero_cartao"]) && isset($_POST["agencia"]) && isset($_POST["codigo_seguranca"]) 
&& isset($_POST["cpf"])) {

    $id_usuario = $_POST["id_usuario"];
    $id_plano = $_POST["id_plano"];
    $numero_cartao = $_POST["numero_cartao"];
    $agencia = $_POST["agencia"];
    $codigo_seguranca = $_POST["codigo_seguranca"];
    $cpf = $_POST["cpf"];
    
    $data_pagamento = date('Y-m-d H:i:s');

    // Calcula a data de expiração com base no plano selecionado
    switch ($id_plano) {
        case 1: // Plano Essencial (3 meses)
            $data_pagamento_expiracao = date('Y-m-d', strtotime('+3 months', strtotime($data_pagamento)));
            break;
        case 2: // Plano Plus (6 meses)
            $data_pagamento_expiracao = date('Y-m-d', strtotime('+6 months', strtotime($data_pagamento)));
            break;
        case 3: // Plano Premium (1 ano)
            $data_pagamento_expiracao = date('Y-m-d', strtotime('+1 year', strtotime($data_pagamento)));
            break;
        default:
            echo "Plano inválido.";
            exit;
    }

    // Insere os dados do pagamento na tabela de pagamento
    $sql = "INSERT INTO pagamento (id_usuario, id_plano, num_cartao, agencia, cod_seguranca, cpf, data_pagamento_expiracao, data_pagamento) 
            VALUES ($id_usuario, $id_plano, '$numero_cartao', '$agencia', '$codigo_seguranca', '$cpf', '$data_pagamento_expiracao', '$data_pagamento')";
    if ($conn->query($sql) === TRUE) {
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
        echo "Erro ao registrar pagamento: " . $conn->error;
    }
} else {
    echo "Dados do pagamento não recebidos.";
}
?>
