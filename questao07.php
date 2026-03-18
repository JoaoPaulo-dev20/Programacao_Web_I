<?php
$idade = 26;
$temcarteira = true;

var_dump($idade >= 18 && $temcarteira); // true
var_dump($idade < 18 || $temcarteira);  // true
var_dump(!$temcarteira);               // false
?>