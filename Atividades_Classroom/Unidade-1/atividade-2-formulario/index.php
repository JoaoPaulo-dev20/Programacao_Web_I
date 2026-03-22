<?php
$nome = "";
$email = "";
$curso = "";
$turno = "";

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nome = trim($_POST["nome"] ?? "");
	$email = trim($_POST["email"] ?? "");
	$curso = trim($_POST["curso"] ?? "");
	$turno = trim($_POST["turno"] ?? "");

	if ($nome == "" || $email == "" || $curso == "" || $turno == "") {
		$erro = "Erro: preencha todos os campos.";
	} else {
		$sucesso = "Cadastro realizado com sucesso! Bem-vindo(a), " . htmlspecialchars($nome) . "!";
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastro de Aluno</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			padding: 20px;
		}
		.formulario {
			max-width: 450px;
		}
		input, select, button {
			width: 100%;
			padding: 8px;
			margin-top: 6px;
			margin-bottom: 10px;
		}
		.erro {
			color: #b00020;
			font-weight: bold;
		}
		.sucesso {
			color: #0f7a2f;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<h1>Simulador de Cadastro</h1>

	<div class="formulario">
		<form method="POST">
			<label>Nome</label>
			<input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>">

			<label>E-mail</label>
			<input type="email" name="email" value="<?= htmlspecialchars($email) ?>">

			<label>Curso</label>
			<input type="text" name="curso" value="<?= htmlspecialchars($curso) ?>">

			<label>Turno</label>
			<select name="turno">
				<option value="">Selecione</option>
				<option value="Matutino" <?= $turno == "Matutino" ? "selected" : "" ?>>Matutino</option>
				<option value="Vespertino" <?= $turno == "Vespertino" ? "selected" : "" ?>>Vespertino</option>
				<option value="Noturno" <?= $turno == "Noturno" ? "selected" : "" ?>>Noturno</option>
			</select>

			<button type="submit">Cadastrar</button>
		</form>
	</div>

	<?php if ($erro != "") { ?>
		<p class="erro"><?= htmlspecialchars($erro) ?></p>
	<?php } ?>

	<?php if ($sucesso != "") { ?>
		<p class="sucesso"><?= $sucesso ?></p>
		<h3>Dados enviados:</h3>
		<ul>
			<li><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></li>
			<li><strong>E-mail:</strong> <?= htmlspecialchars($email) ?></li>
			<li><strong>Curso:</strong> <?= htmlspecialchars($curso) ?></li>
			<li><strong>Turno:</strong> <?= htmlspecialchars($turno) ?></li>
		</ul>
	<?php } ?>
</body>
</html>