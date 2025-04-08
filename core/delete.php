<?php
require_once '../config/db.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
  echo "Slug não fornecido.";
  exit;
}

$stmt = $mysqli->prepare("DELETE FROM lucas_news WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();

header("Location: ../index.php");
exit;
