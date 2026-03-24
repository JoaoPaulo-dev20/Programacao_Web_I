<?php
declare(strict_types=1);

$cookieNome = 'visitante_nome';
$duracaoEmSegundos = 7 * 24 * 60 * 60;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nomeInformado = trim($_POST['nome'] ?? '');

	if ($nomeInformado !== '') {
		setcookie($cookieNome, $nomeInformado, [
			'expires' => time() + $duracaoEmSegundos,
			'path' => '/',
			'httponly' => true,
			'samesite' => 'Lax',
		]);

		header('Location: ' . $_SERVER['PHP_SELF']);
		exit;
	}
}

if (isset($_GET['limpar'])) {
	setcookie($cookieNome, '', [
		'expires' => time() - 3600,
		'path' => '/',
		'httponly' => true,
		'samesite' => 'Lax',
	]);

	header('Location: ' . $_SERVER['PHP_SELF']);
	exit;
}

$nomeVisitante = trim($_COOKIE[$cookieNome] ?? '');
$possuiCookie = $nomeVisitante !== '';
?>
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Atividade 4 - Cookies</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			min-height: 100vh;
			display: grid;
			place-items: center;
			background: #f4f6f8;
		}

		.container {
			background: #ffffff;
			border: 1px solid #d7dde4;
			border-radius: 12px;
			padding: 24px;
			width: min(420px, 92vw);
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
		}

		h1 {
			margin-top: 0;
			font-size: 1.4rem;
		}

		p {
			color: #2d3748;
			line-height: 1.5;
		}

		label {
			display: block;
			margin-bottom: 8px;
			font-weight: 600;
		}

		input[type="text"] {
			width: 100%;
			padding: 10px;
			border: 1px solid #cbd5e0;
			border-radius: 8px;
			box-sizing: border-box;
		}

		button,
		.link {
			display: inline-block;
			margin-top: 12px;
			border: none;
			background: #1f6feb;
			color: #fff;
			padding: 10px 14px;
			border-radius: 8px;
			cursor: pointer;
			text-decoration: none;
			font-size: 0.95rem;
		}

		.link {
			background: #64748b;
		}

		.erro {
			color: #b91c1c;
			margin-top: 8px;
		}
	</style>
</head>
<body>
<main class="container">
	<?php if ($possuiCookie): ?>
		<h1>Bem-vindo(a) de volta!</h1>
		<p>Olá, <strong><?= htmlspecialchars($nomeVisitante, ENT_QUOTES, 'UTF-8') ?></strong>. Seu nome foi lembrado com cookie por 7 dias.</p>
		<a class="link" href="?limpar=1">Esqueci meu nome (apagar cookie)</a>
	<?php else: ?>
		<h1>Primeiro acesso</h1>
		<p>Informe seu nome para que ele seja lembrado nos próximos acessos.</p>
		<form method="post" action="">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" maxlength="80" required>
			<button type="submit">Salvar nome</button>
		</form>
		<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
			<p class="erro">Digite um nome válido para continuar.</p>
		<?php endif; ?>
	<?php endif; ?>
</main>
</body>
</html>
