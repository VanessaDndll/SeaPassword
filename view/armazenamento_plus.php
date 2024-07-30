<?php include '../controller/header.php'; ?>

<?php
// Inicia sessão 
session_start();

// Verifica se o usuário tá logado e pega o ID do usuário
if(isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
} else {
    // Redireciona pra parte de cadastro caso não tenha cadastro
    header("Location: /seapassword/view/entrar.php");
}
?>

<!-- background embaçado -->
<div class="embaço">
    <video autoplay muted loop id="bg-video">
        <source src="\seapassword\img\themesea.mp4" type="video/mp4">
    </video>
</div>

<br>

<!-- formulário do armazenamento -->
<form action="\seapassword\model\inserir_armazenamento_plus.php" method="post" class="arm">

    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>"> <!--passa o ID-->

    <h2 class="armazenamento">ARMAZENAMENTO PLUS</h2>

    <div class="pai">

    <?php
    // pede a conexão com o banco
    require_once __DIR__ .'/../model/conexao.php';

    // caso de erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL pra pegar os dados armazenados
    $sql = "SELECT id_arm, descricao, email_arm, senha_arm FROM armazenamento WHERE id_usuario = $id_usuario";
    $result = $conn->query($sql);

     // Com o resultado ele vai printar na tela o resultado 
    if ($result->num_rows > 0) {   // Verifica se a consulta teve pelo menos 1 resultado
        $i = 1;  //Inicia o contador
        while($row = $result->fetch_assoc()) {  // Loop pra cada linha do resultado da consulta
            printf('
            <div class="input-group">
                <input type="hidden" name="id_arm%s" value="%s">
                
                <label for="descricao%s">Descrição</label>
                <input type="text" name="descricao%s" id="inputs_arm" readonly value="%s">
                
                <label for="email%s">Email</label>
                <input type="email" name="email%s" id="inputs_arm" readonly value="%s">
                
                <label for="senha%s">Senha</label>
                <input type="password" name="senha%s" id="senha%s" class="inputs_arm" readonly value="%s">
                
                <button class="button_mostrar" type="button" onclick="togglePasswordVisibility(\'senha%s\')">👁️‍🗨️</button>
            </div>',
            // Nessa parte o $i vai substituir os %s e os atributos "value" vão ser substituidos pelos valores que o usuário por 
            $i, $row['id_arm'], 
            $i, $i, $row['descricao'],
            $i, $i, $row['email_arm'], 
            $i, $i, $i, $row['senha_arm'], $i);
            $i++;
        }
    } else {
        // Se não houver dados armazenados, exibe os campos de entrada vazios
        for ($i = 1; $i <= 15; $i++) {
            echo "
            <div class='input-group'>
            <th>Descrição</th>
            <td><input type='text' name='descricao$i' id='inputs_arm'></td>

            <th>Email</th>
            <td><input type='email' name='email$i' id='inputs_arm'></td>
            
            <th>Senha</th>
            <td><input type='password' name='senha$i' id='senha$i' class='inputs_arm'></td>

            <button class='button_mostrar' type='button' onclick=\"togglePasswordVisibility('senha$i')\">👁️‍🗨️</button>
            </div>"; 
        }
    }
    
    // Verifica quantas senhas já foram armazenadas pro usuário atual
    $sql_count = "SELECT COUNT(*) as count FROM armazenamento WHERE id_usuario = $id_usuario";
    $result_count = $conn->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $num_senhas_armazenadas = $row_count['count'];

    // Define o limite de senhas
    $limite_senhas = 15;

    if ($num_senhas_armazenadas >= $limite_senhas) {
        echo "<p>Você atingiu o limite máximo de senhas armazenadas.</p>";
        echo "<style>.button_salvar { display: none; }</style>";
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

    <button class="button_salvar" type="submit">SALVAR</button>

</form>

<br>

<?php
// Verifica quantas senhas já foram armazenadas pro usuário atual
$sql_count2 = "SELECT COUNT(*) as count FROM armazenamento WHERE id_usuario = $id_usuario";
$result_count2 = $conn->query($sql_count2);
$row_count2 = $result_count2->fetch_assoc();
$num_senhas_armazenadas2 = $row_count2['count'];

// Define o limite de senhas
$limite_senhas2 = 15;

// Se o número de senhas armazenadas for menor que o limite, o botão "atualizar" não aparece
if ($num_senhas_armazenadas2 < $limite_senhas2) {
    echo "<style>.button_atualizar { display: none; }</style>";
}


?>

<a href="/seapassword/view/update_credencial.php"><button class="button_atualizar">ATUALIZAR</button></a>

<br>

<?php include '../controller/footer.php'; ?>
