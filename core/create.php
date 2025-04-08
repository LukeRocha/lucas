<?php
$mysqli = new mysqli("localhost", "root", "", "lucas_backsite", 3306);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $title = $_POST['title'] ?? '';
  $slug = $_POST['slug'] ?? '';
  $description = $_POST['description'] ?? '';
  $keywords = $_POST['keywords'] ?? '';
  $content= $_POST['content'] ?? '';


if($title && $slug && $content) {
  
  $statement = $mysqli->prepare(
    "INSERT INTO lucas_news (title, slug, description, keywords, content, created_at)
    VALUES (?, ?, ?, ?, ?, NOW())"
  );

  $statement->bind_param("sssss", $title, $slug, $description, $keywords, $content);
  $statement->execute();

  header("Location: index.php");
  exit;

} else {
  echo "Por favor preencha os campos obrigatórios";
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