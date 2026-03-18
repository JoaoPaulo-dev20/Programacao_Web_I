<?php
$texto = "Olá Mundo";

echo strtoupper($texto) . "<br>"; // MAIÚSCULO
echo strtolower($texto) . "<br>"; // minúsculo
echo strlen($texto) . "<br>";     // tamanho
echo str_replace("Mundo", "PHP", $texto) . "<br>";
?>