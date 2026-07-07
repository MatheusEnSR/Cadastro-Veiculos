<style>
.row{
    width: 96%;
}

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
    margin-left: 20px;
    width: 96%;
}

.card-head {
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #1f1e1e;
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
    'cad-model' => __DIR__ . '/../cad-model/cad-model.php',
    'cad-vei'   => __DIR__ . '/../cad-veiculo/cad-vei.php',
    'cad-user'  => __DIR__ . '/../cad-user/cad-user.php',
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
                            class="nav-lin <?= $view === null ? 'active' : '' ?>"
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
            // Se nenhuma view secundária foi chamada por GET, renderiza a HOME com os cards e as tabelas
            if ($view === null) {
                
                // --- 1. CONSULTAS DE MÉTRICAS (Contadores em Tempo Real) ---
                $sqlAtivos = "SELECT COUNT(*) AS total FROM usuarios WHERE status = 1";
                $resAtivos = $conn->query($sqlAtivos);
                $totalAtivos = $resAtivos ? $resAtivos->fetch_object()->total : 0;

                $sqlInativos = "SELECT COUNT(*) AS total FROM usuarios WHERE status = 0";
                $resInativos = $conn->query($sqlInativos);
                $totalInativos = $resInativos ? $resInativos->fetch_object()->total : 0;

                $sqlModelosCount = "SELECT COUNT(*) AS total FROM modelos";
                $resModelosCount = $conn->query($sqlModelosCount);
                $totalModelos = $resModelosCount ? $resModelosCount->fetch_object()->total : 0;

                $sqlVeiculosCount = "SELECT COUNT(*) AS total FROM veiculos";
                $resVeiculosCount = $conn->query($sqlVeiculosCount);
                $totalVeiculos = $resVeiculosCount ? $resVeiculosCount->fetch_object()->total : 0;

                // --- 2. APRESENTAÇÃO DO HTML DO PAINEL PRINCIPAL ---
                echo '<div class="row g-3 mb-4" style="margin-left: 20px;">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="metrica-card">
                                <div class="metrica-label">Usuários Ativos</div>
                                <div class="metrica-valor">' . $totalAtivos . '</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="metrica-card">
                                <div class="metrica-label">Usuários Inativos</div>
                                <div class="metrica-valor">' . $totalInativos . '</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="metrica-card">
                                <div class="metrica-label">Modelos Cadastrados</div>
                                <div class="metrica-valor">' . $totalModelos . '</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="metrica-card">
                                <div class="metrica-label">Veículos Cadastrados</div>
                                <div class="metrica-valor">' . $totalVeiculos . '</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">';

                // 1. TABELA DE VEÍCULOS (Consulta e Apresentação)
                $sqlVei = "SELECT veiculos.*, modelos.nome AS modelos 
                           FROM veiculos 
                           INNER JOIN modelos ON veiculos.modelo_id = modelos.id 
                           ORDER BY veiculos.id DESC LIMIT 3";
                $resVei = $conn->query($sqlVei);

                echo '<div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-head">
                                <span class="card-title">Últimos Veículos Cadastrados</span>
                                <a href="?page=home&view=cad-vei" class="card-action" style="text-decoration:none;">Ver todos</a>
                            </div>
                            <div class="tbl-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Placa</th>
                                            <th>Modelo</th>
                                            <th>Cor</th>
                                            <th>Ano</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                if ($resVei && $resVei->num_rows > 0) {
                    while ($row = $resVei->fetch_object()) {
                        echo '<tr>
                                <td class="bold mono">' . htmlspecialchars($row->placa) . '</td>
                                <td><span class="badge bg-secondary">' . htmlspecialchars($row->modelos) . '</span></td>
                                <td>' . htmlspecialchars($row->cor) . '</td>
                                <td class="bold">' . htmlspecialchars($row->ano) . '</td>
                            </tr>';
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center py-3 text-muted">Nenhum veículo cadastrado.</td></tr>';
                }

                echo '              </tbody>
                                </table>
                            </div>
                        </div>
                    </div>';


                // 2. TABELA DE USUÁRIOS (Consulta e Apresentação)
                $sqlUser = "SELECT id, nome, email, login, status FROM usuarios ORDER BY id DESC LIMIT 3";
                $resUser = $conn->query($sqlUser);

                echo '<div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <span class="card-title">Últimos Usuários Cadastrados</span>
                                <a href="?page=home&view=cad-user" class="card-action" style="text-decoration:none;">Ver todos</a>
                            </div>
                            <div class="tbl-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Login</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                if ($resUser && $resUser->num_rows > 0) {
                    while ($row = $resUser->fetch_object()) {
                        $statusBadge = ($row->status == 1) 
                            ? '<span class="badge bg-success">Ativo</span>' 
                            : '<span class="badge bg-danger">Inativo</span>';

                        echo '<tr>
                                <td>' . htmlspecialchars($row->nome) . '</td>
                                <td>' . htmlspecialchars($row->email) . '</td>
                                <td class="mono">' . htmlspecialchars($row->login) . '</td>
                                <td>' . $statusBadge . '</td>
                            </tr>';
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center py-3 text-muted">Nenhum usuário cadastrado.</td></tr>';
                }

                echo '              </tbody>
                                </table>
                            </div>
                        </div>
                    </div>';

                // Fecha as rows abertas na Home
                echo '    </div>';

            } elseif (isset($viewsPermitidas[$view])) {
                // Se o usuário clicar em Modelos, Veículos ou Usuários, carrega apenas o arquivo do CRUD
                require $viewsPermitidas[$view];
            } else {
                echo '<p class="text-white p-3">Página não encontrada.</p>';
            }
            ?>
        </div>

    </div>
    
    <script>
    const btnConta = document.getElementById("btnConta");
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
    });
    </script>
</body>