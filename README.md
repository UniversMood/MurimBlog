# Blog Murim - Projet CDA

Un blog Symfony sur l'univers du Murim (arts martiaux et cultivation).

## Fonctionnalités

### Entités Principales
- **User** : Système d'authentification avec rôles (USER, ADMIN)
- **Category** : Catégories d'articles (Cultivation, Arts Martiaux, Sectes, Histoire, Alchimie)
- **Article** : Articles de blog avec système de publication
- **Comment** : Commentaires sur les articles

### Fonctionnalités Utilisateur
- Inscription et connexion
- Création, modification et suppression d'articles (pour ses propres articles)
- Système de commentaires
- Navigation par catégories
- Interface responsive avec thème Murim

### Fonctionnalités Admin
- Gestion complète de tous les articles
- Accès aux fonctionnalités d'administration

## Installation

### Prérequis
- PHP 8.1 ou supérieur
- Composer
- Symfony CLI (optionnel mais recommandé)

### Étapes d'installation

1. **Cloner le projet**
```bash
git clone [url-du-repo]
cd murim-blog
```

2. **Installer les dépendances**
```bash
composer install
```

3. **Configurer la base de données**
```bash
# Créer la base de données
php bin/console doctrine:database:create

# Exécuter les migrations
php bin/console make:migration
php bin/console doctrine:migrations:migrate

# Charger les données de démonstration
php bin/console doctrine:fixtures:load
```

4. **Lancer le serveur de développement**
```bash
symfony server:start
# ou
php -S localhost:8000 -t public/
```

## Comptes de Démonstration

### Administrateur
- **Email** : admin@murim.com
- **Mot de passe** : password

### Utilisateurs
- **Email** : jin@murim.com / **Mot de passe** : password
- **Email** : feng@murim.com / **Mot de passe** : password

## Structure du Projet

### Entités
- `src/Entity/User.php` - Gestion des utilisateurs
- `src/Entity/Category.php` - Catégories d'articles
- `src/Entity/Article.php` - Articles de blog
- `src/Entity/Comment.php` - Commentaires

### Contrôleurs
- `src/Controller/HomeController.php` - Page d'accueil
- `src/Controller/ArticleController.php` - CRUD des articles
- `src/Controller/SecurityController.php` - Authentification
- `src/Controller/RegistrationController.php` - Inscription

### Formulaires
- `src/Form/ArticleType.php` - Formulaire d'article
- `src/Form/CommentType.php` - Formulaire de commentaire
- `src/Form/RegistrationFormType.php` - Formulaire d'inscription

### Templates
- `templates/base.html.twig` - Template de base avec design Murim
- `templates/home/` - Page d'accueil
- `templates/article/` - Pages des articles
- `templates/security/` - Pages d'authentification

## Fonctionnalités Techniques

### Sécurité
- Authentification par email/mot de passe
- Hashage sécurisé des mots de passe
- Protection CSRF sur les formulaires
- Contrôle d'accès basé sur les rôles

### Base de Données
- Utilisation de Doctrine ORM
- Relations entre entités (OneToMany, ManyToOne)
- Migrations pour la structure de base
- Fixtures pour les données de démonstration

### Interface Utilisateur
- Design responsive avec Bootstrap 5
- Thème personnalisé inspiré du Murim
- Animations et micro-interactions
- Navigation intuitive

## Thème Murim

Le blog explore l'univers du Murim avec :
- **Cultivation** : Techniques de développement spirituel
- **Arts Martiaux** : Styles de combat et techniques
- **Sectes** : Organisations et clans du monde martial
- **Histoire** : Chroniques et légendes
- **Alchimie** : Création de pilules et élixirs

## Développement

### Commandes Utiles
```bash
# Créer une nouvelle entité
php bin/console make:entity

# Générer une migration
php bin/console make:migration

# Créer un contrôleur
php bin/console make:controller

# Créer un formulaire
php bin/console make:form

# Vider le cache
php bin/console cache:clear
```

### Tests
```bash
# Lancer les tests (si configurés)
php bin/phpunit
```

## Déploiement

Pour déployer en production :

1. Configurer les variables d'environnement dans `.env.local`
2. Optimiser l'autoloader : `composer install --no-dev --optimize-autoloader`
3. Vider et réchauffer le cache : `php bin/console cache:clear --env=prod`
4. Exécuter les migrations : `php bin/console doctrine:migrations:migrate --env=prod`

## Licence

Projet éducatif pour l'examen CDA - Tous droits réservés.