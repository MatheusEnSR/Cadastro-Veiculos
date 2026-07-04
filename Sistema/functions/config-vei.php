<?php

// Sessão é necessária para guardar o usuário logado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$acao = $_REQUEST["acao"] ?? null;

switch ($acao) {




    case 'editar':
        $nome      = $_POST["nome"] ?? '';
        $email     = $_POST["email"] ?? '';
        $dataNasc  = $_POST["data_nasc"] ?? null;
        $id        = $_REQUEST["id"] ?? 0;
        $senhaPura = $_POST["senha"] ?? '';

        if ($senhaPura !== '') {
            // Só re-hasheia se o usuário digitou uma nova senha
            $senhaHash = password_hash($senhaPura, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $nome, $email, $senhaHash, $id);
        } else {
            $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nome, $email, $id);
        }

        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Editado com sucesso'); location.href='?page=cad-user';</script>";
        } else {
            print "<script>alert('Não foi possível editar'); location.href='?page=cad-user';</script>";
        }
        break;

    case 'excluir':
        $id = $_REQUEST["id"] ?? 0;

        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Excluido com sucesso'); location.href='?page=cad-user';</script>";
        } else {
            print "<script>alert('Não foi possível excluir'); location.href='?page=cad-user';</script>";
        }
        break;

    default:
        print "<script>alert('Ação inválida.'); location.href='?page=cad-user';</script>";
}

