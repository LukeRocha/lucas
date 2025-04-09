# 📰 Backsite - Sistema de Notícias em PHP (CRUD)

Este é um sistema de gerenciamento de notícias feito com PHP e MySQL.

## 📂 Estrutura do Projeto

├── config/ 
  │ └── db.php 
  │ └── schema.sql 
├── core/ 
  │ ├── create.php # Criação de notícias 
  │ ├── edit.php # Edição 
  │ ├── delete.php # Exclusão 
  │ ├── list.php # Visualização única 
├── css/ 
  │ └── style.css # Estilo
├── index.php # Página inicial com listagem 

## ✅ Funcionalidades

- Adicionar, editar e remover notícias
- Validação de campos obrigatórios
- Proteção contra SQL Injection via `prepared statements`
- Formatação e exibição segura de conteúdo (`htmlspecialchars`)

## 🚀 Como rodar localmente

1. Clone este repositório
2. Schema disponível para banco de dados (estrutura da tabela: `lucas_news`)
3. Configure seu ambiente local (XAMPP, WAMP, etc.)
4. Acesse `localhost/seu_projeto/index.php`

Criado por Lucas com 💙
