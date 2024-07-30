<?php include '../controller/header.php'; ?>

<?php
// Inicia sessão 
session_start();

// Verifica se o usuário está logado e obtém o ID do usuário
if(isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
} else {
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: view/entrar.php");
    exit;
}
?>

<div class="embaço">
    <video autoplay muted loop id="bg-video">
        <source src="\seapassword\img\themesea.mp4" type="video/mp4">
    </video>
</div>

<br>

<form action="\seapassword\model\update_armazenamento.php" method="post" class="arm">

    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

    <h2 class="armazenamento">ARMAZENAMENTO ESSENCIAL</h2>

    <div class="pai">

    <?php
    require_once __DIR__ .'/../model/conexao.php';

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para pegar os dados armazenados
    $sql = "SELECT id_arm, descricao, email_arm, senha_arm FROM armazenamento WHERE id_usuario = $id_usuario";
    $result = $conn->query($sql);

    // Com o resultado ele vai printar na tela o resultado 
    if ($result->num_rows > 0) {  // Verifica se a consulta teve pelo menos 1 resultado
        $i = 1;  //Inicia o contador
        while($row = $result->fetch_assoc()) {  // Loop pra cada linha do resultado da consulta
            printf('
            <div class="input-group">
                <input type="hidden" name="id_arm%s" value="%s">
                
                <label for="descricao%s">Descrição</label>
                <input type="text" name="descricao%s" id="inputs_arm" value="%s">
                
                <label for="email%s">Email</label>
                <input type="email" name="email%s" id="inputs_arm" value="%s">
                
                <label for="senha%s">Senha</label>
                <input type="password" name="senha%s" id="senha%s" class="inputs_arm" value="%s">
                
                <button class="button_mostrar" type="button" onclick="togglePasswordVisibility(\'senha%s\')">👁️‍🗨️</button>
            </div>',
            // Nessa parte o $i vai substituir os %s e os atributos "value" vão ser substituidos pelos valores que o usuário por 
            $i, $row['id_arm'], 
            $i, $i, $row['descricao'],
            $i, $i, $row['email_arm'], 
            $i, $i, $i, $row['senha_arm'], $i);
            $i++;
        }
    } 
    ?>
    </div>

<script>
// Script pro "olhinho" funcionar
function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
</script>

<button class="button_salvar" type="submit">SALVAR ALTERAÇÕES</button>

</form>

<br>

<?php include '../controller/footer.php'; ?>
