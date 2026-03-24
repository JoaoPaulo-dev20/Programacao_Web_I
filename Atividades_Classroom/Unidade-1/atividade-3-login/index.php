<?php
session_start();

$usuarioValido = "admin";
$senhaValida = "1234";

$erro = "";

if (isset($_GET["acao"]) && $_GET["acao"] === "logout") {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

    if ($usuario === $usuarioValido && $senha === $senhaValida) {
        $_SESSION["autenticado"] = true;
        $_SESSION["usuario"] = $usuario;

        header("Location: index.php");
        exit;
    }

    $erro = "Usuário ou senha inválidos.";
}

$autenticado = isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === true;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 3 - Login com Área Restrita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f7fa;
        }
        .box {
            max-width: 420px;
            background: #fff;
            border: 1px solid #d6dbe2;
            border-radius: 8px;
            padding: 20px;
        }
        input, button {
            width: 100%;
            padding: 9px;
            margin-top: 6px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #bfc8d3;
            border-radius: 5px;
        }
        button {
            border: none;
            background: #0b63ce;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .erro {
            color: #b00020;
            font-weight: bold;
        }
        .logout {
            display: inline-block;
            margin-top: 12px;
            text-decoration: none;
            color: #0b63ce;
            font-weight: bold;
        }
        .dica {
            margin-top: 8px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <?php if (!$autenticado) { ?>
        <div class="box">
            <h1>Sistema de Login</h1>

            <form method="POST" action="">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>

                <button type="submit">Entrar</button>
            </form>

            <?php if ($erro !== "") { ?>
                <p class="erro"><?= htmlspecialchars($erro) ?></p>
            <?php } ?>

            <p class="dica">Credenciais da atividade: usuário <strong>admin</strong> e senha <strong>1234</strong>.</p>
        </div>
    <?php } else { ?>
        <div class="box">
            <h1>Painel Restrito</h1>
            <p>Login realizado com sucesso.</p>
            <p>Bem-vindo, <strong><?= htmlspecialchars($_SESSION["usuario"] ?? "") ?></strong>!</p>
            <p>Esta área só pode ser acessada por usuários autenticados.</p>
            <a class="logout" href="index.php?acao=logout">Sair (Logout)</a>
        </div>
    <?php } ?>
</body>
</html>
