<?php
require_once '../config/db.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
  echo "Slug não fornecido.";
  exit;
}

$stmt = $mysqli->prepare("SELECT * FROM lucas_news WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();

$result = $stmt->get_result();
$noticia = $result->fetch_assoc();

if (!$noticia) {
  echo "Notícia não encontrada.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($noticia['title']) ?></title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h1><?= htmlspecialchars($noticia['title']) ?></h1>
    <p><strong>Publicado em:</strong> <?= date('d/m/Y H:i', strtotime($noticia['created_at'])) ?></p>
    <?php if ($noticia['description']) { ?>
      <p><em><?= htmlspecialchars($noticia['description']) ?></em></p>
    <?php } ?>
    <hr>
    <div class="content">
      <?= nl2br(htmlspecialchars($noticia['content'])) ?>
    </div>
    <hr>
    <p><strong>Palavras-chave:</strong> <?= htmlspecialchars($noticia['keywords']) ?></p>
    <a href="/lucas">← Voltar</a>
  </div>
</body>
</html>
