<?php include '../controller/header.php'; ?>

<div id="container-1">
    <img class="points" src="\seapassword\img\points2.png"></img>
    <div id="bg-video">
        <video autoplay muted loop id="bg-video">
            <source src="\seapassword\img\themesea.mp4" type="video/mp4">
        </video>
    </div>

    <div id="login">

        <h2>Meu Perfil</h2>
        <!-- form pra logar  -->
        <form action="\seapassword\model\perfil_login.php" method="post" id="form_entrar">
            <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" placeholder="Digite seu email..."><br><br>
    
            <label for="senha">Senha:</label><br>
                <input type="text" name="senha" id="senha" placeholder="Digite sua senha..."><br><br>
                <br>
            <button type="submit" id="button_login">Entrar</button>
        </form>
        ____________________________________________________
        <a href="\seapassword\view\registrar.php" class="sem_conta">Ainda não tem conta? Cadastrar.</a>
    </div>
</div>
    

<footer  style="position: fixed">
        <p id=footer-items>© 2024 SeaPassword. All Rights Reserved.</p>
    </footer>
</body>
</html>