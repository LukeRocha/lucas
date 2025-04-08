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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'] ?? '';
  $description = $_POST['description'] ?? '';
  $keywords = $_POST['keywords'] ?? '';
  $content = $_POST['content'] ?? '';

  if ($title && $content) {
    $updateStatement = $mysqli->prepare("
      UPDATE lucas_news
      SET title = ?, description = ?, keywords = ?, content = ?
      WHERE slug = ?
    ");
    $updateStatement->bind_param("sssss", $title, $description, $keywords, $content, $slug);
    $updateStatement->execute();

    header("Location: ../index.php");
    exit;
  } else {
    echo "Título e conteúdo são obrigatórios.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Notícia</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h1>Editar Notícia</h1>

    <form method="post" class="form">
      <label>Título:</label>
      <input type="text" name="title" value="<?= htmlspecialchars($noticia['title']) ?>" required>

      <label>Descrição:</label>
      <input type="text" name="description" value="<?= htmlspecialchars($noticia['description']) ?>">

      <label>Palavras-chave:</label>
      <input type="text" name="keywords" value="<?= htmlspecialchars($noticia['keywords']) ?>">

      <label>Conteúdo:</label>
      <textarea name="content" rows="6" required><?= htmlspecialchars($noticia['content']) ?></textarea>

      <button type="submit">Salvar Alterações</button>
    </form>

    <a href="../index.php">← Voltar</a>
  </div>
</body>
</html>
