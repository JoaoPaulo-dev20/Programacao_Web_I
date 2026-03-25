<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/src/Auth.php';
require_once __DIR__ . '/src/CookieManager.php';
require_once __DIR__ . '/src/Validator.php';
require_once __DIR__ . '/src/AlunoService.php';

$auth = new Auth();
$cookieManager = new CookieManager();
$validator = new Validator();
$alunoService = new AlunoService(__DIR__ . '/storage/alunos.json');

$acao = $_GET['acao'] ?? '';
$erroLogin = '';
$mensagem = '';
$errosFormulario = [];

$form = [
    'nome' => '',
    'email' => '',
    'curso' => '',
    'turno' => '',
    'nota' => '',
];

if ($acao === 'logout') {
    $auth->logout();
    header('Location: index.php');
    exit;
}

if ($acao === 'limpar_cookie') {
    $cookieManager->clearVisitorName();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';

    if ($tipo === 'login') {
        $usuario = trim((string)($_POST['usuario'] ?? ''));
        $senha = trim((string)($_POST['senha'] ?? ''));

        if (!$auth->attemptLogin($usuario, $senha)) {
            $erroLogin = 'Usuario ou senha invalidos.';
        } else {
            header('Location: index.php');
            exit;
        }
    }

    if ($tipo === 'aluno' && $auth->isAuthenticated()) {
        $form['nome'] = trim((string)($_POST['nome'] ?? ''));
        $form['email'] = trim((string)($_POST['email'] ?? ''));
        $form['curso'] = trim((string)($_POST['curso'] ?? ''));
        $form['turno'] = trim((string)($_POST['turno'] ?? ''));
        $form['nota'] = trim((string)($_POST['nota'] ?? ''));

        $errosFormulario = $validator->validateAluno($form);

        if (count($errosFormulario) === 0) {
            $notaFloat = (float)$form['nota'];
            $situacao = $validator->classify($notaFloat);

            $registro = [
                'nome' => $form['nome'],
                'email' => $form['email'],
                'curso' => $form['curso'],
                'turno' => $form['turno'],
                'nota' => number_format($notaFloat, 1, '.', ''),
                'situacao' => $situacao,
                'criadoEm' => date('Y-m-d H:i:s'),
            ];

            if ($alunoService->save($registro)) {
                $cookieManager->setVisitorName($form['nome']);
                $mensagem = 'Aluno registrado com sucesso.';
                $form = [
                    'nome' => '',
                    'email' => '',
                    'curso' => '',
                    'turno' => '',
                    'nota' => '',
                ];
            } else {
                $errosFormulario[] = 'Nao foi possivel salvar os dados. Tente novamente.';
            }
        }
    }
}

$autenticado = $auth->isAuthenticated();
$usuarioLogado = $auth->getUsername();
$visitante = $cookieManager->getVisitorName();
$registros = $autenticado ? $alunoService->all() : [];
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Integrador - Portal Academico - JP</title>
    <style>
        :root {
            --bg: #f4f0e8;
            --bg-card: #fffdf8;
            --ink: #1f1d1a;
            --muted: #6a6357;
            --line: #d9cfbf;
            --brand: #0f766e;
            --brand-strong: #0b5d57;
            --ok: #17643e;
            --bad: #a12f2f;
            --warn: #9b6a00;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: var(--ink);
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at 10% 20%, #efe3cd 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, #dceeea 0%, transparent 35%),
                var(--bg);
            min-height: 100vh;
        }

        .wrap {
            width: min(1100px, 92vw);
            margin: 28px auto;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
        }

        h1, h2 {
            margin-top: 0;
            letter-spacing: 0.2px;
        }

        p { color: var(--muted); }

        .grid {
            display: grid;
            gap: 16px;
        }

        .grid-2 {
            grid-template-columns: 1fr;
        }

        @media (min-width: 860px) {
            .grid-2 {
                grid-template-columns: 1.2fr 1fr;
            }
        }

        label {
            display: block;
            font-weight: 700;
            margin-bottom: 6px;
        }

        input, select, button {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #bfb39f;
            padding: 10px;
            font-size: 15px;
        }

        button {
            border: none;
            background: var(--brand);
            color: #fff;
            cursor: pointer;
            font-weight: 700;
            transition: background 0.2s;
        }

        button:hover { background: var(--brand-strong); }

        .topbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 16px;
        }

        .links a {
            color: var(--brand-strong);
            text-decoration: none;
            margin-left: 10px;
            font-weight: 700;
        }

        .status-ok { color: var(--ok); font-weight: 700; }
        .status-warn { color: var(--warn); font-weight: 700; }
        .status-bad { color: var(--bad); font-weight: 700; }

        .msg {
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 10px;
        }

        .msg-ok {
            background: #e6f4eb;
            border: 1px solid #b7debf;
            color: var(--ok);
        }

        .msg-erro {
            background: #fdecec;
            border: 1px solid #f5c4c4;
            color: var(--bad);
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            text-align: left;
            border-bottom: 1px solid #e6ddcf;
            padding: 9px 8px;
            white-space: nowrap;
        }

        th {
            background: #f4eee2;
            color: #3e372d;
        }
    </style>
</head>
<body>
<div class="wrap">
    <?php if (!$autenticado): ?>
        <section class="card" style="max-width: 460px; margin: 30px auto;">
            <h1>Portal Academico Integrador</h1>
            <p>Entre com as credenciais da atividade para acessar o painel.</p>
            <p><strong>Usuario:</strong> admin | <strong>Senha:</strong> 1234</p>

            <?php if ($erroLogin !== ''): ?>
                <div class="msg msg-erro"><?= htmlspecialchars($erroLogin, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <input type="hidden" name="tipo" value="login">

                <label for="usuario">Usuario</label>
                <input id="usuario" name="usuario" type="text" required>

                <label for="senha">Senha</label>
                <input id="senha" name="senha" type="password" required>

                <button type="submit">Entrar</button>
            </form>
        </section>
    <?php else: ?>
        <section class="card">
            <div class="topbar">
                <div>
                    <h1>Painel Integrador</h1>
                    <p>Bem-vindo, <strong><?= htmlspecialchars($usuarioLogado, ENT_QUOTES, 'UTF-8') ?></strong>.</p>
                    <?php if ($visitante !== ''): ?>
                        <p>Ultimo aluno salvo: <strong><?= htmlspecialchars($visitante, ENT_QUOTES, 'UTF-8') ?></strong></p>
                    <?php endif; ?>
                </div>
                <div class="links">
                    <a href="?acao=limpar_cookie">Limpar cookie</a>
                    <a href="?acao=logout">Sair</a>
                </div>
            </div>

            <div class="grid grid-2">
                <div class="card" style="box-shadow: none;">
                    <h2>Cadastro e Classificacao</h2>

                    <?php if ($mensagem !== ''): ?>
                        <div class="msg msg-ok"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endif; ?>

                    <?php if (count($errosFormulario) > 0): ?>
                        <div class="msg msg-erro">
                            <?php foreach ($errosFormulario as $erro): ?>
                                <div><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="">
                        <input type="hidden" name="tipo" value="aluno">

                        <label for="nome">Nome</label>
                        <input id="nome" name="nome" type="text" value="<?= htmlspecialchars($form['nome'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="email">E-mail</label>
                        <input id="email" name="email" type="email" value="<?= htmlspecialchars($form['email'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="curso">Curso</label>
                        <input id="curso" name="curso" type="text" value="<?= htmlspecialchars($form['curso'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <label for="turno">Turno</label>
                        <select id="turno" name="turno" required>
                            <option value="">Selecione</option>
                            <option value="Matutino" <?= $form['turno'] === 'Matutino' ? 'selected' : '' ?>>Matutino</option>
                            <option value="Vespertino" <?= $form['turno'] === 'Vespertino' ? 'selected' : '' ?>>Vespertino</option>
                            <option value="Noturno" <?= $form['turno'] === 'Noturno' ? 'selected' : '' ?>>Noturno</option>
                        </select>

                        <label for="nota">Nota (0 a 10)</label>
                        <input id="nota" name="nota" type="number" min="0" max="10" step="0.1" value="<?= htmlspecialchars($form['nota'], ENT_QUOTES, 'UTF-8') ?>" required>

                        <button type="submit">Salvar aluno</button>
                    </form>
                </div>

                <div class="card" style="box-shadow: none;">
                    <h2>Historico de Registros</h2>
                    <p>Dados persistidos em arquivo JSON local.</p>
                    <div class="table-wrap">
                        <table>
                            <thead>
                            <tr>
                                <th>Aluno</th>
                                <th>Curso</th>
                                <th>Turno</th>
                                <th>Nota</th>
                                <th>Situacao</th>
                                <th>Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (count($registros) === 0): ?>
                                <tr>
                                    <td colspan="6">Nenhum registro encontrado.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($registros as $item): ?>
                                    <?php
                                    $situacao = (string)($item['situacao'] ?? '');
                                    $classe = 'status-bad';
                                    if ($situacao === 'Aprovado') {
                                        $classe = 'status-ok';
                                    } elseif ($situacao === 'Recuperacao') {
                                        $classe = 'status-warn';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars((string)($item['nome'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars((string)($item['curso'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars((string)($item['turno'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars((string)($item['nota'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="<?= $classe ?>"><?= htmlspecialchars($situacao, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars((string)($item['criadoEm'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>
</body>
</html>
