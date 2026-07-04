<?php

$acao = $_REQUEST["acao"] ?? null;

switch ($acao) {

    case 'cadastrar':
        $nome  = $_POST["nome"] ?? '';
        $marca = $_POST["marca"] ?? '';

        $sql = "INSERT INTO modelos (nome, marca) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nome, $marca);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Cadastro com sucesso'); location.href='index.php?page=home&view=cad-model';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar'); location.href='index.php?page=home&view=cad-model';</script>";
        }
        break;

    case 'editar':
        $nome  = $_POST["nome"] ?? '';
        $marca = $_POST["marca"] ?? '';
        $id    = $_REQUEST["id"] ?? 0;

        $sql = "UPDATE modelos SET nome = ?, marca = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nome, $marca, $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Editado com sucesso'); location.href='index.php?page=home&view=cad-model';</script>";
        } else {
            print "<script>alert('Não foi possível editar'); location.href='index.php?page=home&view=cad-model';</script>";
        }
        break;

    case 'excluir':
        $id = $_REQUEST["id"] ?? 0;

        $sql = "DELETE FROM modelos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Excluído com sucesso'); location.href='index.php?page=home&view=cad-model';</script>";
        } else {
            print "<script>alert('Não foi possível excluir'); location.href='index.php?page=home&view=cad-model';</script>";
        }
        break;
}