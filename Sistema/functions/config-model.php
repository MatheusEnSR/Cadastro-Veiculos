<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$acao = $_REQUEST["acao"] ?? null;

switch ($acao) {

    case 'cadastrar-modelo':
        $nome  = $_POST["nome_modelo"] ?? '';
        $marca = $_POST["marca"] ?? '';

        if ($nome === '' || $marca === '') {
            print "<script>alert('Preencha todos os campos.'); location.href='?page=home&view=cad-model';</script>";
            break;
        }

        $sql = "INSERT INTO modelos (nome_modelo, marca) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nome, $marca);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Modelo cadastrado'); location.href='?page=home&view=cad-model';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar'); location.href='?page=home&view=cad-model';</script>";
        }
        break;

    case 'editar-modelo':
        $id    = $_REQUEST["id"] ?? 0;
        $nome  = $_POST["nome_modelo"] ?? '';
        $marca = $_POST["marca"] ?? '';

        $sql = "UPDATE modelos SET nome_modelo = ?, marca = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nome, $marca, $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Editado com sucesso'); location.href='?page=home&view=cad-model';</script>";
        } else {
            print "<script>alert('Não foi possível editar'); location.href='?page=home&view=cad-model';</script>";
        }
        break;

    case 'excluir-modelo':
        $id = $_REQUEST["id"] ?? 0;

        $sql = "DELETE FROM modelos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Excluído com sucesso'); location.href='?page=home&view=cad-model';</script>";
        } else {
            print "<script>alert('Não foi possível excluir'); location.href='?page=home&view=cad-model';</script>";
        }
        break;

    default:
        print "<script>alert('Ação inválida.'); location.href='?page=home&view=cad-model';</script>";
}