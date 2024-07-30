<?php include '../controller/header.php'; ?>

<div id="container-1">
    <img class="points" src="\seapassword\img\points2.png"></img>
    <div id="bg-video">
        <video autoplay muted loop id="bg-video">
            <source src="\seapassword\img\themesea.mp4" type="video/mp4">
        </video>
    </div>

    <div id="login">

        <h2>Cadastrar-se</h2>

        <!-- form pra criar sua conta, manda pra parte que vai verificar se o email já tá cadastrado -->
        <form action="\seapassword\model\inserir_registro.php" method="post" id="form_entrar">
            <label for="nome">Nome:</label><br>
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome..."><br><br>

            <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" placeholder="Digite seu email..."><br><br>

            <label for="senha">Senha:</label><br>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha...">
                
                <button class="button_mostrar" id="olhinho" type="button" onclick="togglePasswordVisibility('senha')">👁️‍🗨️</button>
                <br><br>

            <button type="submit" id="button_login">Entrar</button>
        </form>
    </div>
</div>

<!-- script pro "olhinho" funcionar -->
<script>
function togglePasswordVisibility(inputId) {
var passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
</script>

<footer  style="position: fixed">
        <p id=footer-items>© 2024 SeaPassword. All Rights Reserved.</p>
    </footer>
</body>
</html>