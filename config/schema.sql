 CREATE DATABASE IF NOT EXISTS lucas_backsite;
 USE lucas_backsite;

 CREATE TABLE lucas_news (
   id INT AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(255) NOT NULL,
   slug VARCHAR(255) NOT NULL,
   description TEXT,
   keywords TEXT,
   content TEXT,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  );
 