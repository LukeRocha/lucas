<?php
require_once '../config/db.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
  echo "Slug não fornecido.";
  exit;
}

$statement = $mysqli->prepare("DELETE FROM lucas_news WHERE slug = ?");
$statement->bind_param("s", $slug);
$statement->execute();

header("Location: ../index.php");
exit;
