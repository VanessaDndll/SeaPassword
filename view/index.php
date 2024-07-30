<?php include '../controller/header.php'; ?>

<div id="container-1">
    <img class="points" src="\seapassword\img\points2.png"></img>
        <div id="bg-video">
            <video autoplay muted loop id="bg-video">
                <source src="\seapassword\img\themesea.mp4" type="video/mp4">
            </video>      

            <script>
            // Atualiza o desfoque com base no deslocamento da página
            window.addEventListener('scroll', function() {
              const scrollTop = window.scrollY;
              const blurAmount = Math.min(scrollTop / 50, 10);
              const blurElement = document.getElementById('bg-video');
              blurElement.style.filter = `blur(${blurAmount}px)`;
            });
            </script>

        </div>
        <p id="subtitleup">Navegue com Confiança, Proteja com SeaPassword.</p>
        <span id="sea">Sea</span>
        <span id="pass">Password</span>

    <button type="button" id="button">Entrar</button>
    <script src="\seapassword\controller\script.js"></script>
</div>

<div class="container-mid">
    <p id="container-mid-p">- Objetivos da Empresa -</p>
</div>

<div id="container-2">
    <div id="left_main">
        <p id="title">- QUEM SOMOS? -</p>
        <p id="subtitle">Na SeaPassword, acreditamos que a segurança cibernética é como explorar o oceano: 
                cheio de mistérios e desafios. Nossa missão é simplificar a maneira como você gerencia suas 
                credenciais online, garantindo que suas senhas estejam sempre protegidas e acessíveis, mesmo 
                quando você estiver navegando nas águas mais profundas.</p>
    </div>

    <div id="right_main">
        <p id="title2">- OBJETIVOS -</p>
        <p id="subtitle2"> Segurança Intransigente: Nosso principal objetivo é proteger suas senhas com a 
            mesma tenacidade que os recifes de coral protegem suas criaturas marinhas. Utilizamos criptografia 
            avançada e práticas de segurança rigorosas para manter suas informações fora do alcance de qualquer 
            tubarão digital.</p>
    </div>
</div>

<div class="container-mid">
    <p id="container-mid-p2">- PLANOS -</p>
</div>

<!-- GIMP -->
<div class ="container-3">
    <div class="cont3left" tag="CONTEUDO">
            <section>
                <h2 class="aboutgimp"><i>Planos</i></h2>
                    <p class="aboutgimp">Estamos comprometidos em oferecer um planos robustos e seguros para 
                        proteger suas senhas. Assim como o SeaPassword, nossa solução visa simplificar o gerenciamento de 
                        suas credenciais online.</p>
            </section>
        </div>
    <div class="cont3right" tag="CONTEUDO ">
    <img id="skillimage"src="\seapassword\img\submarinho.png"></img>
    </div>
</div>

<!-- BLENDER -->
<div class ="container-4">
    <div class="cont4right" tag="CONTEUDO DIREITO">
    <img id="skillimage"src="\seapassword\img\seabonit.png">
    </div>
    
    <div class="cont4left" tag="CONTEUDO ESQUERDO">
            <section>
                <h2 class="aboutblender"><i>Junte-se a nós</i></h2>
                    <p class="aboutblender">Junte-se à SeaPassword e mergulhe na segurança cibernética com confiança. 
                        Visite nosso site em SeaPassword para começar hoje mesmo!
                        Lembre-se: suas senhas são como pérolas preciosas no fundo do mar. Mantenha-as seguras com a SeaPassword. </p>
            </section>
    </div>
</div>

<?php include '../controller/footer.php'; ?>