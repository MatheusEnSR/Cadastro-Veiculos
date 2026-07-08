<?php

// Sessão é necessária para guardar o usuário logado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$acao = $_REQUEST["acao"] ?? null;

switch ($acao) {

    case 'cadastrar':
        $nome      = $_POST["nome"] ?? '';
        $email     = $_POST["email"] ?? '';
        $senhaPura = $_POST["senha"] ?? '';
        $dataNasc  = $_POST["data_nasc"] ?? null;

        if ($nome === '' || $email === '' || $senhaPura === '') {
            print "<script>alert('Preencha todos os campos.'); location.href='?page=cad-user';</script>";
            break;
        }


        $senhaHash = password_hash($senhaPura, PASSWORD_DEFAULT);


        $sql = "INSERT INTO usuarios (nome, email, senha, status) VALUES (?, ?, ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senhaHash);
        $res = $stmt->execute();
        $stmt->close();

        if ($res) {
            print "<script>alert('Cadastro com sucesso'); location.href='?page=login';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar'); location.href='?page=cad-user';</script>";
        }
        break;

  case 'login':

    $email = $_POST["email"] ?? '';
    $senhaPura = $_POST["senha"] ?? '';

    if ($email == '' || $senhaPura == '') {
        echo "<script>
                alert('Preencha email e senha.');
                location.href='?page=login';
              </script>";
        exit;
    }

    $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows == 1){

        $usuario = $resultado->fetch_assoc();

        if(password_verify($senhaPura, $usuario['senha'])){

            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            $update = $conn->prepare("UPDATE usuarios SET status = 1 WHERE id = ?");
            $update->bind_param("i",$usuario['id']);
            $update->execute();

            header("Location: index.php?page=home");
            exit;
        }
    }

    echo "<script>
            alert('Email ou senha inválidos');
            location.href='?page=login';
          </script>";

break;

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
            print "<script>alert('Editado com sucesso'); location.href='?page=listar';</script>";
        } else {
            print "<script>alert('Não foi possível editar'); location.href='?page=listar';</script>";
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
            print "<script>alert('Excluido com sucesso'); location.href='?page=listar';</script>";
        } else {
            print "<script>alert('Não foi possível excluir'); location.href='?page=listar';</script>";
        }
        break;

    default:
        print "<script>alert('Ação inválida.'); location.href='?page=login';</script>";
}

