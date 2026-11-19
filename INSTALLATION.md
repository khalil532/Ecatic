# ECATIC — Guide d'installation (XAMPP / Windows)

Ce dossier est une **surcouche Laravel** : il contient tout le code du projet (contrôleurs, modèles, migrations,
vues Blade, CSS, JS, seeders, routes…) à copier sur une installation Laravel neuve.
Aucune compilation front (npm/Vite) n'est nécessaire : Bootstrap 5, Font Awesome et Google Fonts sont chargés par CDN
(connexion Internet requise au premier chargement).

## 0. Prérequis
- **XAMPP** avec **PHP 8.2 ou plus** (Apache + MySQL). Dans `php.ini`, vérifiez que ces extensions sont actives :
  `extension=gd`, `extension=mbstring`, `extension=pdo_mysql`, `extension=fileinfo`, `extension=zip` (retirer le `;`).
- **Composer** : https://getcomposer.org/download/

## 1. Créer le projet Laravel
Ouvrez un terminal (CMD / PowerShell) dans `C:\xampp\htdocs` :
```
composer create-project laravel/laravel:^11.0 ecatic
cd ecatic
```

## 2. Copier les fichiers ECATIC
Copiez **tout le contenu** du dossier `ecatic/` de cette archive **dans** `C:\xampp\htdocs\ecatic\`
et acceptez de **remplacer** les fichiers existants (bootstrap/app.php, routes/web.php, app/Models/User.php,
app/Providers/AppServiceProvider.php, database/seeders/DatabaseSeeder.php).

## 3. Créer la base MySQL
1. Démarrez **Apache** et **MySQL** dans le panneau XAMPP.
2. Ouvrez http://localhost/phpmyadmin → **Nouvelle base de données** → nom : `ecatic`,
   interclassement : `utf8mb4_unicode_ci` → Créer.

## 4. Configurer le `.env`
Ouvrez le fichier `.env` du projet et reprenez les valeurs de `.env.ecatic.example`
(base `ecatic`, utilisateur `root`, mot de passe vide, `ADMIN_EMAIL`, `ADMIN_PASSWORD`…).
Ne publiez **jamais** le fichier `.env`.

## 5. Initialiser l'application
```
php artisan key:generate
php artisan migrate --seed
```
La commande crée les tables (users, activities, services, projects, project_images, contact_messages,
quote_requests, site_settings), charge les textes officiels, les activités, les services, 4 projets
**« démo »** clairement identifiés, et le compte administrateur défini dans `.env`.

## 6. Lancer le site
```
php artisan serve
```
- Site : http://localhost:8000
- Administration : http://localhost:8000/admin (identifiants = `ADMIN_EMAIL` / `ADMIN_PASSWORD` du `.env`)

*(Alternative Apache : pointez le DocumentRoot / un VirtualHost vers `C:\xampp\htdocs\ecatic\public`.)*

## 7. Logo et bannières
Le logo officiel et les 2 bannières ECATIC sont **déjà inclus** dans `public/images/` (`logo.png`, `banner-1.jpg`, `banner-2.jpg`). Pour les remplacer, gardez les mêmes noms.

## 8. Personnaliser depuis /admin
- **Paramètres du site** : nom, slogan, textes « À propos », téléphone, WhatsApp, e-mail de contact,
  URL Google Maps (iframe), réseaux sociaux, titre/description SEO.
- **Activités / Services / Réalisations** : ajout, modification, suppression, images.
- **Messages / Devis** : lecture, « marquer comme traité », suppression, changement de statut.
- Supprimez ou remplacez les 4 projets « démo » par vos vraies réalisations.

## 9. Avant la mise en ligne
- `.env` : `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://votre-domaine`, mot de passe MySQL fort.
- Modifier l'URL du sitemap dans `public/robots.txt` (ligne `Sitemap:`).
- `php artisan config:cache && php artisan route:cache && php artisan view:cache`
- Servir uniquement le dossier `public/` ; activer HTTPS ; sauvegarder la base régulièrement.
- Changer le mot de passe administrateur après la première connexion si besoin
  (modifier `ADMIN_PASSWORD` puis `php artisan db:seed --class=AdminUserSeeder`).

## Dépannage
- *Page blanche / erreur 500* : `storage/` et `bootstrap/cache/` doivent être accessibles en écriture.
- *Images non enregistrées* : vérifier `extension=gd` (sinon les images sont enregistrées sans optimisation) et que `public/uploads/` est inscriptible.
- *Migration « Access denied »* : vérifier `DB_USERNAME` / `DB_PASSWORD` dans `.env`.
- Après modification du `.env` : `php artisan config:clear`.

---
## Base de données MySQL (phpMyAdmin) — configuration déjà faite
Le fichier `.env` de ce dossier utilise **déjà MySQL** (`DB_DATABASE=ecatic`, `DB_USERNAME=root`, mot de passe vide : réglages XAMPP par défaut).

1. Démarrez **Apache** et **MySQL** dans XAMPP.
2. Dans http://localhost/phpmyadmin, créez la base **`ecatic`** (interclassement `utf8mb4_unicode_ci`).
3. Deux options au choix :
   - **Par Laravel** : `php artisan migrate:fresh --seed`
   - **Par phpMyAdmin** : onglet *Importer* → fichier `database/ecatic.sql` (tables + données initiales).
4. `php artisan serve` → http://localhost:8000 — administration : http://localhost:8000/admin
   (identifiants dans `.env` : `ADMIN_EMAIL` / `ADMIN_PASSWORD` — **changez le mot de passe**).

## Images des activités
Les 3 photos des activités sont dans `public/images/activities/` (`agrobusiness.jpg`, `import-export.jpg`, `transport-logistique.jpg`) et reliées par le seeder.
Elles peuvent être remplacées depuis `/admin` → Activités → Modifier → Image.

## E-mail de contact
L'adresse **Contact.ecatic@gmail.com** s'affiche sur l'accueil, la page Contact et le pied de page. Si votre base est déjà installée, lancez simplement `php artisan migrate` : l'e-mail est ajouté sans écraser une valeur déjà saisie. Modifiable ensuite dans `/admin` → Paramètres du site → Coordonnées de contact.
