<?php
$mysqli = new mysqli("localhost", "root", "", "lucas_backsite", 3306);
$news = [];

if (!$mysqli->connect_errno) {
  $stmt = $mysqli->prepare("SELECT title, slug, description, created_at FROM lucas_news ORDER BY created_at DESC LIMIT 5");
  $stmt->execute();
  $result = $stmt->get_result();
  $news = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Notícias</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h1>Últimas Notícias</h1>

    <?php foreach ($news as $item): ?>
      <div class="card">
        <h2><?= htmlspecialchars($item['title']) ?></h2>
        <small><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></small>
        <p><?= htmlspecialchars($item['description']) ?></p>
        <a href="noticia.php?slug=<?= urlencode($item['slug']) ?>">Ler mais</a>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
