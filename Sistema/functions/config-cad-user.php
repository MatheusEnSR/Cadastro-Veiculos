<?php

$acao = $_REQUEST["acao"] ?? null;

switch ($acao) {

    case 'cadastrar':
        $placa     = $_POST["placa"] ?? '';
        $cor       = $_POST["cor"] ?? '';
        $ano       = $_POST["ano"] ?? '';
        $modelo_id = $_POST["modelo_id"] ?? '';

        $sql = "INSERT INTO veiculos (placa, cor, ano, modelo_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $placa, $cor, $ano, $modelo_id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Cadastro com sucesso'); location.href='index.php?page=home&view=cad-vei';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar'); location.href='index.php?page=home&view=cad-vei';</script>";
        }
        break;

    case 'editar':
        $placa     = $_POST["placa"] ?? '';
        $cor       = $_POST["cor"] ?? '';
        $ano       = $_POST["ano"] ?? '';
        $modelo_id = $_POST["modelo_id"] ?? '';
        $id        = $_REQUEST["id"] ?? 0;

        $sql = "UPDATE veiculos SET placa = ?, cor = ?, ano = ?, modelo_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $placa, $cor, $ano, $modelo_id, $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Editado com sucesso'); location.href='index.php?page=home&view=cad-vei';</script>";
        } else {
            print "<script>alert('Não foi possível editar'); location.href='index.php?page=home&view=cad-vei';</script>";
        }
        break;

    case 'excluir':
        $id = $_REQUEST["id"] ?? 0;

        $sql = "DELETE FROM veiculos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Excluído com sucesso'); location.href='index.php?page=home&view=cad-vei';</script>";
        } else {
            print "<script>alert('Não foi possível excluir'); location.href='index.php?page=home&view=cad-vei';</script>";
        }
        break;
}