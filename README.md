📌 Description du projet

Ce projet consiste en la réécriture et sécurisation d’une application de gestion de parc informatique initialement développée en PHP « pur ».
L’objectif principal était d’assurer la conformité avec l’OWASP Top 10, en mettant en place une architecture MVC moderne, des pratiques de développement sécurisé et un durcissement de la configuration serveur.

🎯 Objectifs

Reprendre une application existante vulnérable.

Implémenter une architecture MVC claire et maintenable.

Garantir la conformité aux exigences de sécurité OWASP Top 10.

Appliquer les bonnes pratiques PHP (cf. PHP: The Right Way).

Mettre en place des mécanismes robustes de sécurité applicative et serveur.

🛠️ Stack technique

Langage : PHP 8+

Base de données : MySQL/MariaDB (via PDO et requêtes préparées)

Serveur web : Apache 2 (configuration sécurisée via .htaccess)

Architecture : MVC (dossiers /app/models, /app/controllers, /app/views)

Encodage : UTF-8 (utf8mb4 pour la BDD)

🔐 Fonctionnalités de sécurité implémentées

Architecture MVC : séparation claire Modèle / Vue / Contrôleur.

Authentification et gestion des sessions sécurisées ($_SESSION['user_id']).

Protection CSRF : génération et validation de tokens uniques dans les formulaires.

Sanitization des entrées utilisateur : filter_var() avec filtres stricts.

Requêtes préparées via PDO : prévention des injections SQL.

Échappement des données en sortie : helper e() encapsulant htmlspecialchars().

Redirection HTTPS : règles .htaccess (RewriteCond/RewriteRule).

Durcissement serveur : directives php.ini (désactivation exec, shell_exec, etc.).

Headers HTTP de sécurité :

X-Content-Type-Options: nosniff

X-Frame-Options: DENY

X-XSS-Protection: 1; mode=block

Referrer-Policy: no-referrer

Content-Security-Policy: default-src 'self'


README.md

🚀 Installation

Cloner le dépôt :

git clone https://github.com/username/gestion-parc-securisee.git
cd gestion-parc-securisee


Configurer la base de données (MySQL/MariaDB) avec les scripts fournis.

Adapter le fichier /config/config.php avec vos identifiants BDD.

Configurer Apache pour pointer vers le dossier /public.

Vérifier que HTTPS est activé et .htaccess opérationnel.

✅ Bonnes pratiques appliquées

Respect strict de la séparation des responsabilités.

Nettoyage et validation systématique des entrées.

Échappement des sorties pour prévenir XSS.

Logs d’erreurs centralisés, pas affichés en prod.

Cookies de session sécurisés (HttpOnly, Secure, SameSite=Strict).

👥 Contributeurs

Jean-Yann Julians – Développement & sécurité applicative

Clément Wahaga – Développement & intégration

📖 Références

OWASP Top 10

PHP: The Right Wayamdnin : admin@example.com mdp : Password123
user : user@example.com : Password1234

