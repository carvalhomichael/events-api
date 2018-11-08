Events API
===

**A propos**

Ce projet a été réalisé à partir du framework Symfony (version 3.4).
La base de données utilisée est sous MySQL 5.7.

**Installation**

1) Faire un ```composer install``` à la racine du projet
2) Créer le fichier de configuration [app/config/parameters.yml](app/config/parameters.yml) à partir du fichier app/config/parameters.yml.dist afin de configurer l'accès à votre base de données (paramètres database*).
3) Lancer la migration de la base de données : ``php bin/console doctrine:schema:update --dump-sql --force`` depuis la racine du projet.

**Dump SQL**

```
CREATE TABLE tweet (
    id INT AUTO_INCREMENT NOT NULL, 
    username VARCHAR(20) NOT NULL, 
    message VARCHAR(1000) NOT NULL, 
    hashtags VARCHAR(255) DEFAULT NULL, 
    created_at DATETIME NOT NULL, 
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
```

**Endpoints**

Les endpoints sont disponibles à partir de la [collection Postman](endpoints.postman_collection.json) disponible à la racine du projet : 