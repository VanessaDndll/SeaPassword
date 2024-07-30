<?php include '../controller/header.php'; ?>

    <div id="bg-video">
        <video autoplay muted loop id="bg-video">
            <source src="\seapassword\img\themesea.mp4" type="video/mp4">
        </video>
    </div>

<?php
// Inicia sessão
session_start();

if (!isset($_SESSION["id_usuario"])) { //Verifica se o X usuário ta logado
    header("Location: perfil_entrar.php");
    exit();
}

require_once __DIR__ .'/../model/conexao.php';

$id_usuario = $_SESSION["id_usuario"];

// Consultar informações do usuário e do plano
$sql = "SELECT u.email_usuario, u.senha, p.id_plano, p.data_pagamento, p.data_pagamento_expiracao
        FROM usuario u
        LEFT JOIN pagamento p ON u.id_usuario = p.id_usuario
        WHERE u.id_usuario = ?";
$stmt = $conn->prepare($sql); //Preparação contra injeção SQL
$stmt->bind_param("i", $id_usuario); // Põe o parametro do id_usuario na consulta, o i indica que é um valor inteiro
$stmt->execute(); // Execulta a consulta
$stmt->bind_result($email, $senha, $id_plano, $data_pagamento, $data_expiracao); // Pega o resultado da consulta e vincula com as variáveis
$stmt->fetch(); // Pega a próxima linha de resultado da consulta epreenche as variáveis
$stmt->close(); // Fecha a preparação

// Definir nome do plano com base no ID do plano
$nome_plano = '';
switch ($id_plano) {
    case 1:
        $nome_plano = 'Essencial';
        break;
    case 2:
        $nome_plano = 'Plus';
        break;
    case 3:
        $nome_plano = 'Premium';
        break;
    default:
        $nome_plano = 'Nenhum plano ativo';
        break;
}

$conn->close();
?>

<br>

<h1 class="title_meu_perfil">MINHAS INFORMAÇÕES</h1>

<br>

<div class="informacoes">
<!-- Vai adicionar o valor das variáveis e isso põe como texto simples mesmo que tenha caractere especial -->
<p class="email_meu_perfil">Email: <?php echo htmlspecialchars($email); ?></p>
<p class="senha_meu_perfil">Senha: <?php echo htmlspecialchars($senha); ?></p>
<p class="plano_meu_perfil">Plano: <?php echo htmlspecialchars($nome_plano); ?></p>
<p class="data_pagamento_meu_perfil">Data de Pagamento: <?php echo htmlspecialchars($data_pagamento); ?></p>
<p class="data_expiracao_meu_perfil">Data de Expiração: <?php echo htmlspecialchars($data_expiracao); ?></p>
</div>

<br>

<form action="/seapassword/model/deletar_conta.php" method="post">

    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

    <button type="submit" class="button_excluir" onclick="return confirm('Você tem certeza que deseja deletar sua conta?')">Deletar Conta</button>
    
</form>

<br>

<?php include '../controller/footer.php'; ?>
