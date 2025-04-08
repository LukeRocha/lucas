<?php
require_once '../config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $slug = trim($_POST['slug'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $keywords = trim($_POST['keywords'] ?? '');
  $content = trim($_POST['content'] ?? '');

  $slug = strtolower(preg_replace('/[^a-z0-9-]+/', '-', $slug));
  $slug = trim($slug, '-');

  if ($title && $slug && $content) {
    $check = $mysqli->prepare("SELECT id FROM lucas_news WHERE slug = ?");
    $check->bind_param("s", $slug);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {
      $error = "Já existe uma notícia com esse slug.";
    } else {
      $statement = $mysqli->prepare(
        "INSERT INTO lucas_news (title, slug, description, keywords, content, created_at)
         VALUES (?, ?, ?, ?, ?, NOW())"
      );

      $statement->bind_param("sssss", $title, $slug, $description, $keywords, $content);
      $statement->execute();

      header("Location: ../index.php");
      exit;
    }
  } else {
    $error = "Por favor preencha os campos obrigatórios.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Criar Notícia</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h1>Criar Nova Notícia</h1>

    <?php if ($error): ?>
      <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" class="form">
      <label>Título:</label>
      <input type="text" name="title" required>

      <label>Slug (ex: minha-noticia):</label>
      <input type="text" name="slug" required>

      <label>Descrição:</label>
      <input type="text" name="description">

      <label>Palavras-chave:</label>
      <input type="text" name="keywords">

      <label>Conteúdo:</label>
      <textarea name="content" rows="6" required></textarea>

      <button type="submit">Salvar</button>
    </form>

    <a href="../index.php">← Voltar</a>
  </div>
</body>
</html>
