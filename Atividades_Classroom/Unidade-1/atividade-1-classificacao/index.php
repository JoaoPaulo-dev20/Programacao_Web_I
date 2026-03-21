<?php
// Função de classificação
function classificarEstudante($nota) {
    if ($nota >= 7){
        return "Aprovado";
    } elseif ($nota >= 5){
        return "Recuperação";
    } else {
        return "Reprovado";
    }
}

// Captura da nota via formulário
$notainformada = isset($_POST['nota']) ? $_POST['nota'] : null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Classificação Acadêmica</title>
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
        .resultado { font-weight: bold; color: #2c3e50; }
        .sequencia { color: #7f8c8d; }
        .erro { color: red; }
    </style>
</head>
<body>

<h1>Sistema de Classificação Acadêmica - JP</h1>

<!-- FORMULÁRIO -->
<form method="POST">
    Digite a nota: 
    <input type="number" name="nota" step="0.1" required>
    <button type="submit">Verificar</button>
</form>

<hr>

<?php
// Validação e exibição
if ($notainformada !== null) {

    // Validação básica
    if ($notainformada < 0 || $notainformada > 10) {
        echo "<p class='erro'>Digite uma nota válida (0 a 10).</p>";
    } else {

        $situacao = classificarEstudante($notainformada);

        echo "<p>A nota do aluno foi: <strong>$notainformada</strong></p>";
        echo "<p>Situação Final: <span class='resultado'>$situacao</span></p>";

        echo "<h3>Sequência de Notas:</h3>";
        echo "<p class='sequencia'>";

        // Loop (convertendo para inteiro)
        for ($i = 0; $i <= (int)$notainformada; $i++) {
            echo $i . ($i < (int)$notainformada ? " - " : "");
        }

        echo "</p>";
    }
}
?>

</body>
</html>