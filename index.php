<?php
require_once './config/db.php';
$news = [];

if (!$mysqli->connect_errno) {
  $statement = $mysqli->prepare("SELECT title, slug, description, created_at FROM lucas_news ORDER BY created_at DESC");

  if ($statement) {
    $statement->execute();
    $result = $statement->get_result();
    $news = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    echo "Erro ao preparar statement: " . $mysqli->error;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Notícias</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <div class="container">
    <h1>Últimas Notícias - Backsite</h1>
    <div class="button-wrapper">
  <a href="./core/create.php" class="button create">+ Nova Notícia</a>
</div>


    <?php foreach ($news as $item): ?>
      <div class="card">
        <h2><?= htmlspecialchars($item['title']) ?></h2>
        <small><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></small>
        <p><?= htmlspecialchars($item['description']) ?></p>
        <a href="./core/list.php?slug=<?= urlencode($item['slug']) ?>">Ler mais</a>
      </div>

    <?php endforeach; ?>
  </div>
</body>
</html>
