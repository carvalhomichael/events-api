Events API
===

**A propos**

Ce projet a été réalisé à partir du framework Symfony (version 3.4).
La base de données utilisée est sous MySQL 5.7.

**Installation**

1) Récupérer les sources du projet : ``git clone git@github.com:carvalhomichael/events-api.git [directory-name]``
2) Faire un ```composer install``` à la racine du projet. Ils vous sera demandé de renseigner les paramètres de configuration pour accéder à votre base de données (paramètres database*).
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

4) Déployer votre projet : ``php bin/console server:run`` et accéder à l'url indiquée dans votre navigateur ou Postman.

**Endpoints**

Les endpoints sont disponibles à partir de la [collection Postman](endpoints.postman_collection.json) disponible à la racine du projet.
