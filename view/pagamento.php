<?php include '../controller/header.php'; ?>

<?php
// Inicia a sessão
session_start();
// Verifica se o ID do usuário tá na sessão
if(isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
} else {
    // Redireciona pra parte de cadastro caso não tenha cadastro
    header("Location: /seapassword/view/registrar.php");
}
// Captura o ID do plano a partir da URL
if(isset($_GET["id_plano"])) {
    $id_plano = $_GET["id_plano"];
} else {
    echo "ID do plano não encontrado.";
    exit;
}
?>

<div class="embaço">
    <video autoplay muted loop id="bg-video">
        <source src="\seapassword\img\themesea.mp4" type="video/mp4">
    </video>
</div>

<h1 class="pagamento">PAGAMENTO</h1>

<div class="box_pagamento">

    <!-- form pro pagamento, redireciona pra salvar os dados do cartão -->
    <form action="\seapassword\model\inserir_pagamento.php" method="post">

        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <input type="hidden" name="id_plano" value="<?php echo $id_plano; ?>">

        <label for="num_cartao">Número do cartão</label><br>
            <input type="text" name="numero_cartao" id="numero_cartao" maxlength="19" placeholder="1234 5678 9012 3456"><br><br>
        
        <label for="agencia">Agência</label><br>
            <input type="text" name="agencia" id="agencia" maxlength="4" placeholder="1234"><br><br>
    
        <label for="cod_seguranca">Código de segurança</label><br>
            <input type="text" name="codigo_seguranca" id="codigo_seguranca" maxlength="3" placeholder="123"><br><br>
        
        <label for="CPF">CPF</label><br>
            <input type="text" name="cpf" id="cpf" maxlength="14" placeholder="123456789-01"><br><br>

        <button type="submit" id="button_pagar">Pagar</button>
        
    </form>
</div>

<script>
// script pro cpf
document.getElementById("cpf").addEventListener("input", function(event) {
    let input = event.target;
    // Remove todos os caracteres não numéricos
    let value = input.value.replace(/\D/g, ''); 
    if (value.length > 9) {
        // Adiciona um hífen após o nono dígito
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
    } else {
        // Não há hífen antes do nono dígito
        value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
    }
    input.value = value;

});
    // script pro número do cartão
    document.getElementById("numero_cartao").addEventListener("input", function(event) {
        let input = event.target;
        // Remove espaços em branco
        let value = input.value.replace(/\s+/g, ''); 
        // Adiciona um espaço depois de cada quatro dígitos
        value = value.replace(/(\d{4})(?=\d)/g, "$1 "); 
        input.value = value;
    });

</script>
    
<br>

<footer  style="position: fixed">
        <p id=footer-items>© 2024 SeaPassword. All Rights Reserved.</p>
    </footer>
</body>
</html>
