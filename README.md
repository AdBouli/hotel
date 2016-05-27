Gestion hôtelière
=================

Pré-requis
----------
Serveur web apache 2 avec rewrite_module activé
Serveur de base de donnée MySQL 5.5
PHP 5.6 minimum

Installation
------------
Décompressez l'archive.
Placer le dossier à la racine de votre serveur web.
Exécuter dans l'ordre les fichiers sql suivants dans votre SGBD:
 - 01_init_hotel.sql
 - 10_struct_hotel.sql
 - 15_triggers_hotel.sql

Configuration
-------------
Editer le fichier database.php (situé dans `conf/`),
Renseignez l'adresse du serveur de base de donnée, l'identifiant MySQL et le mot de passe.

MySQL
-----
Les fichiers sql se situent dans le répertoire `datas/sql/`
Vous pouvez également insérer des données tests:
 - 20_datas_test_hotel.sql
Pour supprimer toutes les données:
 - 09_clear_tables.sql

Connection
----------
Vous pouvez vous connecter à l'application avec les identifiants suivant:
- 'admin'
- 'mdp'
Les utilisateurs 'toto' et 'tata' présent dans les données de tests ont également pour mot de passe 'mdp'.

Contact
-------
Adrien <adrien.boulineau@laposte.net>
