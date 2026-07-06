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
    <link rel="icon" type="image" href="https://i.pinimg.com/736x/0b/47/e3/0b47e3abfd7c19f1fbd7b2c1565fe756.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Sistema Concessionária</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php
    if (file_exists("assets/styles/$pagina.css")) {
        echo '<link rel="stylesheet" href="assets/styles/' . $pagina . '.css">';
    }
    // Dentro da home, o conteúdo do meio pode ser cad-user/cad-model/cad-vei,
    // então já deixamos o CSS deles disponível também.
    if ($pagina === 'home') {
        foreach (['cad-user', 'cad-model', 'cad-vei'] as $extra) {
            if (file_exists("assets/styles/$extra.css")) {
                echo '<link rel="stylesheet" href="assets/styles/' . $extra . '.css">';
            }
        }
    }
    ?>
</head>

<body class="fundo">

    <?php

    switch ($pagina) {


    case 'login':
        require "pages/login/login.php";
        break;

     case 'cad-login':
        require "pages/cad-login/cad-login.php";
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

    case 'cad-vei':
        require "pages/cad-veiculo/cad-vei.php";
        break;

    case 'salvar':
        require "functions/salvar-user.php";
        break;

    case 'config-model':
        require "functions/config-model.php";
        break;

    case 'config-cad':
        require "functions/config-cad-user.php";
        break;

    case 'config-user':
        require "functions/config-user.php";
        break;

    case 'config-vei':
        require "functions/config-vei.php";
        break;

    default:
        echo "<h2>Página não encontrada.</h2>";
}

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>