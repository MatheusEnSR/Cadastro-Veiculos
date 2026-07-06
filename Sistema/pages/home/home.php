<?php
// Qual conteúdo mostrar dentro da área central da home.
// Vem da URL: ?page=home&view=cad-model
$view = $_GET['view'] ?? null;

// Lista branca de views permitidas — nunca dar require direto em
// algo vindo do usuário sem validar, senão vira Local File Inclusion.
$viewsPermitidas = [
    'cad-model'   => __DIR__ . '/../cad-model/cad-model.php',
    'cad-vei' => __DIR__ . '/../cad-veiculo/cad-vei.php',
    'cad-user'    => __DIR__ . '/../cad-user/cad-user.php',
];
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="icon" type="image" href="https://upload.wikimedia.org/wikipedia/commons/9/96/Clube_de_Regatas_do_Flamengo_logo.svg">

<body>

    <div class="d-flex">

        <div class="sidebar">
            <div id="titulo">
                <img src="https://i.pinimg.com/736x/0b/47/e3/0b47e3abfd7c19f1fbd7b2c1565fe756.jpg" class="hero-logo" alt="">
                <h3>Check Car</h3>
            </div>

            <div id="principal">
                <h1 class="nav-label">PRINCIPAL</h1>
                <ul>
                    <li class="nav-iten">
                        <a href="?page=home&view=cad-model"
                            class="nav-lin <?= $view === 'cad-model' ? 'active' : '' ?>"
                            style="color: white;">
                            Modelos
                        </a>
                    </li>

                    <li class="nav-iten">
                        <a href="?page=home&view=cad-vei"
                            class="nav-lin <?= $view === 'cad-vei' ? 'active' : '' ?> text-white">
                            Veículos
                        </a>
                    </li>

                    <li class="nav-iten">
                        <a href="?page=home&view=cad-user"
                            class="nav-lin <?= $view === 'cad-user' ? 'active' : '' ?> text-white">
                            Usuarios
                        </a>
                    </li>
                </ul>
                <div class="baixo" id="menuConta">
    <button class="conta-btn" id="btnConta">
        <i class="fa-solid fa-user"></i>
        <span>Minha conta</span>
    </button>

    <div class="conta-menu" id="contaMenu" style="display: none;">
        <a href="login.html" class="conta-menu-item">
            <i class="fa-solid fa-user"></i>
            Login
        </a>

        <button class="conta-menu-item conta-menu-sair" id="btnSair">
            <i class="fa-solid fa-right-from-bracket"></i>
            Sair
        </button>
    </div>
</div>
                    </div>
        </div>

        <div class="principal">
            <?php
            if ($view === null) {
                echo '<h2>Bem-vindo(a)!</h2><p>Selecione uma opção no menu ao lado.</p>';
            } elseif (isset($viewsPermitidas[$view])) {
                require $viewsPermitidas[$view];
            } else {
                echo '<p>Página não encontrada.</p>';
            }
            ?>
        </div>

    </div>
    <script>const btnConta = document.getElementById("btnConta");
const contaMenu = document.getElementById("contaMenu");
const btnSair = document.getElementById("btnSair");

// Abre e fecha o menu
btnConta.addEventListener("click", () => {
    if (contaMenu.style.display === "block") {
        contaMenu.style.display = "none";
    } else {
        contaMenu.style.display = "block";
    }
});

// Fecha o menu ao clicar fora
document.addEventListener("click", (e) => {
    const menu = document.getElementById("menuConta");

    if (!menu.contains(e.target)) {
        contaMenu.style.display = "none";
    }
});

// Função de sair
btnSair.addEventListener("click", () => {
    localStorage.removeItem("usuario");
    sessionStorage.clear();

    alert("Você saiu da conta.");

    window.location.href = "login";
});</script>
</body>