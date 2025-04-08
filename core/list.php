<?php
require_once '../config/db.php';

$slug = $_GET['slug'] ?? null;

if (!$slug) {
  echo "Slug não fornecido.";
  exit;
}

$statement = $mysqli->prepare("SELECT * FROM lucas_news WHERE slug = ?");
$statement->bind_param("s", $slug);
$statement->execute();

$result = $statement->get_result();
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="container">
    <div class="card">
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

      <?php if ($noticia['keywords']) { ?>
        <p><strong>Palavras-chave:</strong> <?= htmlspecialchars($noticia['keywords']) ?></p>
      <?php } ?>
      <div class="action-buttons">
        <div>
          <a href="/lucas">← Voltar</a>
        </div>
        <div>
        <a href="../core/edit.php?slug=<?= urlencode($noticia['slug']) ?>" class="button edit">Editar</a>
<a href="../core/delete.php?slug=<?= urlencode($noticia['slug']) ?>" class="button delete" onclick="return confirm('Tem certeza que deseja excluir esta notícia?')">Excluir</a>

        </div>
        </div>
    </div>
  </div>
</body>
</html>
