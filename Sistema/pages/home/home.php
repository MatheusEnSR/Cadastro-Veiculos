
<style>

/* ── Estilos para o código do ECHO novo ── */
.metrica-card {
    background: #292929;
    margin-top: 10px;
    border-radius: 12px;
    padding: 14px 16px;
}

.metrica-label {
    font-size: 10px;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 500;
    margin-bottom: 4px;
}

.metrica-valor {
    font-size: 24px;
    font-weight: 600;
    color: #A09EBB;
    line-height: 1;
}

.card {
    background: #292929;
    border: 1px solid #e8e6f8;
    border-radius: 12px;
    overflow: hidden;
}

.card-head {
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #1f1e1e;
}
.card{
    margin-left: 20px;
}

.card-title {
    font-size: 13px;
    font-weight: 600;
    color: #A09EBB;
}

.card-action {
    font-size: 11px;
    color: #534ab7;
    background: none;
    border: none;
    cursor: pointer;
    font-family: inherit;
}
.card-action:hover { text-decoration: underline; }

.tbl-wrap { overflow-x: auto; }
</style>

<?php

$view = $_GET['view'] ?? null;

$viewsPermitidas = [
    'home'   => __DIR__ . 'home.php',
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
                        <a href="?page=home"
                            class="nav-lin <?= $view === 'home' ? 'active' : '' ?>"
                            style="color: white;">
                            Inicio
                        </a>
                    </li>

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
            
echo '<div class="container-fluid p-0">
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="metrica-card">
                <div class="metrica-label">Usuarios Ativos</div>
                <div class="metrica-valor">7</div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="metrica-card">
                <div class="metrica-label">Usuarios inativos</div>
                <div class="metrica-valor">2</div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="metrica-card">
                <div class="metrica-label">Modelos cadastrados</div>
                <div class="metrica-valor">1</div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="metrica-card">
                <div class="metrica-label">Veiculos cadastrados</div>
                <div class="metrica-valor">3</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-head">
                    <span class="card-title">Resumo dos Projetos</span>
                    <button class="card-action">3 projeto(s)</button>
                </div>
                <div class="tbl-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Projeto</th>
                                <th>Tipo</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bold">Ana Souza</td>
                                <td><span class="badge">Site institucional</span></td>
                                <td><span class="badge">Serviço Único</span></td>
                                <td><span class="badge">Concluído</span></td>
                                <td class="bold mono">R$&nbsp;2.800,00</td>
                            </tr>
                            <tr>
                                <td class="bold">Carlos Mendes</td>
                                <td><span class="badge">App de delivery</span></td>
                                <td><span class="badge">Serviço Único</span></td>
                                <td><span class="badge">Em andamento</span></td>
                                <td class="bold mono">R$&nbsp;12.000,00</td>
                            </tr>
                            <tr>
                                <td class="bold">Loja BellaVida</td>
                                <td><span class="badge">Dashboard financeiro</span></td>
                                <td><span class="badge">Plano</span></td>
                                <td><span class="badge">Concluído</span></td>
                                <td class="bold mono">R$&nbsp;350,00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>';
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