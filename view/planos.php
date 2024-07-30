<?php include '../controller/header.php'; ?>

<?php
// Inicia a sessão
session_start();
// Verifica se o ID do usuário ta na sessão
if(isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];
} else {
    // Redireciona pra parte de cadastro caso não tenha cadastro
    header("Location:/seapassword/view/registrar.php");
}
?>

<video autoplay muted loop id="bg-video">
    <source src="\seapassword\img\themesea.mp4" type="video/mp4">
</video>

<h1 class="planos">PLANOS</h1><br>

<!-- essencial -->
<div class="op">
    <h2 class="essencial_title">Essencial</h2>
    <ul class="essencial_term">
        <li>• Necessário</li>
        <li>• 5 Credenciais</li>
        <li>• 3 Meses</li><br>
    </ul>
    <p class="valor_essencial">R$9.99</p><br>
    <a href="\seapassword\view\pagamento.php?id_usuario=<?php echo $id_usuario; ?>&id_plano=1"><button class="button_essencial" type="submit">ESCOLHER</button></a> 
</div>

<!-- plus -->
<div class="op">
    <h2 class="plus_title">Plus</h2>
    <ul class="plus_term">
        <li>• Mais segurança </li>
        <li>• 15 Credenciais</li>
        <li>• 6 meses</li><br>
    </ul>
    <p class="valor_essencial">R$14.99</p><br>
    <a href="\seapassword\view\pagamento.php?id_usuario=<?php echo $id_usuario; ?>&id_plano=2"><button class="button_essencial" type="submit">ESCOLHER</button></a> 
</div>

<!-- premium -->
<div class="op">
    <h2 class="premium_title">Premium</h2>
    <ul class="premium_term">
        <li>• Mais legal</li>
        <li>• 20 Credenciais</li>
        <li>• 12 Meses</li><br>
    </ul>
    <p class="valor_essencial">R$19.99</p><br>
    <a href="\seapassword\view\pagamento.php?id_usuario=<?php echo $id_usuario; ?>&id_plano=3"><button class="button_essencial" type="submit">ESCOLHER</button></a> 
</div>

<br>
<br>
<br>
<br>

<footer  style="position: fixed">
        <p id=footer-items>© 2024 SeaPassword. All Rights Reserved.</p>
    </footer>
</body>
</html>