<?php

require_once "config/conexao.php";

$pagina = $_GET['page'] ?? 'login';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema Concessionária</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php
    // Carrega o CSS da página atual
    if (file_exists("assets/styles/$pagina.css")) {
        echo '<link rel="stylesheet" href="assets/styles/' . $pagina . '.css">';
    }
    ?>
</head>
<body class="fundo">

<?php

switch ($pagina) {

    case 'login':
        require "pages/login/login.php";
        break;

    case 'home':
        require "pages/home/home.php";
        break;

    case 'cad-user':
    require "pages/cad-user/cad-user.php";
    break;

    case 'cad-model':
        require "pages/cad-model/cad-model.php";
        break;

    case 'cad-veiculo':
        require "pages/cad-veiculo/cad-vei.php";
        break;

    default:
        echo "<h2>Página não encontrada.</h2>";
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>