<?php
function contador() {
    static $num = 0; // mantém valor entre chamadas
    $num++;
    echo $num . "<br>";
}

contador();
contador();
contador();
?>