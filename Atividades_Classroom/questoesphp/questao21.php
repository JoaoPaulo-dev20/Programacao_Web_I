<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agenda Estudantil</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 350px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background: green;
            color: white;
            border: none;
        }

        .resultado {
            margin-top: 15px;
            padding: 10px;
            background: #e7f3ff;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Agenda do Dia</h2>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" name="idade" placeholder="Idade" required>
        <input type="text" name="compromisso" placeholder="Compromisso" required>

        <button type="submit">Salvar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Segurança básica
        $nome = htmlspecialchars($_POST["nome"]);
        $email = htmlspecialchars($_POST["email"]);
        $idade = htmlspecialchars($_POST["idade"]);
        $compromisso = htmlspecialchars($_POST["compromisso"]);

        if (!empty($nome) && !empty($email) && !empty($idade) && !empty($compromisso)) {

            echo "<div class='resultado'>";
            echo "<strong> Compromisso registrado:</strong><br><br>";
            echo "Nome: $nome <br>";
            echo "Email: $email <br>";
            echo "Idade: $idade <br>";
            echo "Compromisso: $compromisso";
            echo "</div>";

        } else {
            echo "<p>Preencha todos os campos!</p>";
        }
    }
    ?>
</div>

</body>
</html>