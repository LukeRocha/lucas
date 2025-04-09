# 📰 Backsite - Sistema de Notícias em PHP (CRUD)

Este é um sistema de gerenciamento de notícias feito com PHP e MySQL.

## 📂 Estrutura do Projeto

├── config/  <br>

 └── db.php <br>
└── schema.sql <br>

├── core/ <br>

└── create.php # Criação de notícias <br>
└── edit.php # Edição <br>
└── delete.php # Exclusão <br>
└──list.php # Visualização única <br>

├── css/ <br>

└── style.css # Estilo <br>
└── index.php # Página inicial com listagem <br>

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
