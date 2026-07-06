<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$acao = $_REQUEST["acao"] ?? null;

switch ($acao) {

    case 'cadastrar':
        $nome  = $_POST["nome"] ?? '';
        $email = $_POST["email"] ?? '';
        $login = $_POST["login"] ?? '';
        $senha = $_POST["senha"] ?? '';

        if ($nome === '' || $email === '' || $login === '' || $senha === '') {
            print "<script>alert('Preencha todos os campos obrigatórios'); location.href='?page=cad-user';</script>";
            break;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, login, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            print "<script>alert('Erro ao preparar cadastro: " . addslashes($conn->error) . "'); location.href='?page=cad-user';</script>";
            break;
        }

        $stmt->bind_param("ssss", $nome, $email, $login, $senhaHash);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Cadastrado com sucesso'); location.href='?page=cad-user';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar'); location.href='?page=cad-user';</script>";
        }
        break;

    case 'editar':
        $nome      = $_POST["nome"] ?? '';
        $email     = $_POST["email"] ?? '';
        $login     = $_POST["login"] ?? '';
        $id        = $_REQUEST["id"] ?? 0;
        $senhaPura = $_POST["senha"] ?? '';

        if ((int)$id <= 0) {
            print "<script>alert('ID inválido para edição'); location.href='?page=cad-user';</script>";
            break;
        }

        if ($senhaPura !== '') {
            $senhaHash = password_hash($senhaPura, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nome = ?, email = ?, login = ?, senha = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                print "<script>alert('Erro SQL: " . addslashes($conn->error) . "'); location.href='?page=cad-user';</script>";
                break;
            }

            $stmt->bind_param("ssssi", $nome, $email, $login, $senhaHash, $id);
        } else {
            $sql = "UPDATE usuarios SET nome = ?, email = ?, login = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                print "<script>alert('Erro SQL: " . addslashes($conn->error) . "'); location.href='?page=cad-user';</script>";
                break;
            }

            $stmt->bind_param("sssi", $nome, $email, $login, $id);
        }

        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Editado com sucesso'); location.href='index.php?page=home&view=cad-user';</script>";
        } else {
            print "<script>alert('Não foi possível editar'); location.href='index.php?page=home&view=cad-user';</script>";
        }
        break;

    case 'excluir':
        $id = $_REQUEST["id"] ?? 0;

        if ((int)$id <= 0) {
            print "<script>alert('ID inválido para exclusão'); location.href='?page=cad-user';</script>";
            break;
        }

        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            print "<script>alert('Erro SQL: " . addslashes($conn->error) . "'); location.href='?page=cad-user';</script>";
            break;
        }

        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Excluído com sucesso'); location.href='?page=cad-user';</script>";
        } else {
            print "<script>alert('Não foi possível excluir'); location.href='?page=cad-user';</script>";
        }
        break;

    default:
        print "<script>alert('Ação inválida.'); location.href='?page=cad-user';</script>";
}