<?php

$mysqli = new mysqli("localhost", "root", "", "lucas_backsite", 3306);
if ($mysqli->connect_error) {
  die("Falha na conexão: " . $mysqli->connect_error);
}
?>
