<?php

session_start();

require_once __DIR__ . "/../config/conexao.php";

if (isset($_SESSION['usuario_id'])) {

    $id = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("UPDATE usuarios SET status = 0 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

session_destroy();

 print "<script>alert('Sessão finalizada'); location.href='index.php?page=login';</script>";   
exit;