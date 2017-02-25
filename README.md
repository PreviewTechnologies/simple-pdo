###MySQL PDO Simple Library


####Installation

`composer require previewtechs/pdo-simple`


####Usage
```php
<?php
require 'vendor/autoload.php';

$pdo = new \Previewtechs\Database\MySQL\PDO(MYSQL_DSN, MYSQL_USERNAME, MYSQL_PASSWORD);

$pdo->query("INSERT INTO users (id, name, email, created) VALUES (NULL , :name, :email, :created)");

$pdo->bind(':name', "Your Name");
$pdo->bind(':email', "your@email.com");
$pdo->bind(':created', date("Y-m-d H:i:s"));

$pdo->execute();

echo $pdo->lastInsertedId();    //should return ID from database
```


####Sample Database

```sql
CREATE DATABASE IF NOT EXISTS test_db;

CREATE TABLE IF NOT EXISTS `test_db`.`users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

```