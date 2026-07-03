<?php
// Qual conteúdo mostrar dentro da área central da home.
// Vem da URL: ?page=home&view=cad-model
$view = $_GET['view'] ?? null;

// Lista branca de views permitidas — nunca dar require direto em
// algo vindo do usuário sem validar, senão vira Local File Inclusion.
$viewsPermitidas = [
    'cad-model'   => __DIR__ . '/../cad-model/cad-model.php',
    'cad-veiculo' => __DIR__ . '/../cad-veiculo/cad-vei.php',
    'cad-user'    => __DIR__ . '/../cad-user/cad-user.php',
];
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="icon" type="image" href="https://upload.wikimedia.org/wikipedia/commons/9/96/Clube_de_Regatas_do_Flamengo_logo.svg">

<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" style="color: #710707;" href="index.php?page=home">
            Car-Check
        </a>
    </div>
</nav>

<div class="d-flex">

    <div class="sidebar">

        <a class="d-flex align-items-center text-white text-decoration-none">
            <span class="fs-4">Menu</span>
        </a>

        <hr>

        <ul class="nav nav-pills flex-column">

            <li class="nav-item">
                <a href="?page=home&view=cad-model"
                   class="nav-link <?= $view === 'cad-model' ? 'active' : '' ?>"
                   style="color: white;">
                    Modelos
                </a>
            </li>

            <li>
                <a href="?page=home&view=cad-veiculo"
                   class="nav-link <?= $view === 'cad-veiculo' ? 'active' : '' ?> text-white">
                    Veículos
                </a>
            </li>

            <li>
                <a href="?page=home&view=cad-user"
                   class="nav-link <?= $view === 'cad-user' ? 'active' : '' ?> text-white">
                    Usuarios
                </a>
            </li>

        </ul>
        <hr style="margin-top: 44vh;">
        <div class="">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none">
                <svg width="32" height="32" class="rounded-circle me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                <strong>Minha conta</strong>
            </a>
        </div>

    </div>

    <div class="content">
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

</body>