# Deployer ECATIC sur Hostinger

## 1. Prérequis

Dans hPanel, activez :

- PHP **8.2 ou 8.3**
- les extensions `mbstring`, `pdo_mysql`, `fileinfo`, `gd`, `zip`
- une base MySQL
- SSH, si votre offre le permet

Laravel 12 nécessite PHP 8.2 minimum.

## 2. Recuperer les fichiers

Depuis votre ordinateur :

```bash
cd "C:\Users\HP\Desktop\ECATIC PROJET\ECATIC-projet-complet\ecatic"
composer install --no-dev --optimize-autoloader
npm install
npm run build
```

Excluez au minimum `.env`, `.git`, les fichiers locaux et les dossiers temporaires. Conservez `vendor/` si vous n'utilisez pas SSH/Composer sur Hostinger.

## 3. Installer les fichiers

Uploadez le projet via le Gestionnaire de fichiers ou FTP dans :

```text
/domains/votre-domaine/public_html/   # methode simple
```

Dans hPanel, configurez ensuite la racine web du domaine sur :

```text
/domains/votre-domaine/public_html/public
```

Le dossier `public` doit etre le seul dossier accessible directement depuis le navigateur.

Si Hostinger propose un dossier `laravel` ou autorise SSH, vous pouvez aussi placer Laravel hors de `public_html` et ne conserver que son dossier `public` dans la racine web.

## 4. Creer la base MySQL

Dans hPanel :

1. Ouvrez **Bases de donnees MySQL**.
2. Creez une base avec un interclassement `utf8mb4_unicode_ci`.
3. Creez un utilisateur MySQL fort.
4. Affectez cet utilisateur a la base avec tous les privileges.

## 5. Configurer `.env`

Copiez `.env.example` en `.env`, puis configurez au minimum :

```env
APP_NAME=ECATIC
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://votre-domaine.sn

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=utilisateur_mysql
DB_PASSWORD=mot_de_passe_mysql

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public

ADMIN_NAME="Administrateur ECATIC"
ADMIN_EMAIL=admin@votre-domaine.sn
ADMIN_PASSWORD="mot-de-passe-fort"
```

Gelez `APP_KEY` apres sa premiere generation : ne le changez pas apres mise en production.

Avec SSH :

```bash
php artisan key:generate
php artisan migrate --seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Sans SSH, utilisez temporairement une commande Hostinger disponible dans hPanel, ou importez `database/ecatic.sql` dans phpMyAdmin avant de configurer les donnees administrateur.

## 6. Droits des dossiers

Donnez les droits d'ecriture a :

- `storage/`
- `bootstrap/cache/`
- `public/uploads/`

Valeur normale : dossiers en `755`, fichiers en `644`.

## 7. Verifier l'administration

Ouvrez :

```text
https://votre-domaine/admin/login
```

Les identifiants proviennent de `ADMIN_EMAIL` et `ADMIN_PASSWORD` dans `.env`.

## 8. Depannage rapide

- **Page blanche ou erreur 500** : rendez `storage/` et `bootstrap/cache/` accessibles en ecriture, puis lancez `php artisan config:clear`.
- **Erreur SQL** : verifiez le nom exact de la base, l'utilisateur, le mot de passe et `DB_HOST`.
- **Images absentes** : executez `php artisan storage:link` et verifiez `public/uploads/`.
- **Acces direct aux fichiers .env** : confirmez que seul `public/` est la racine web.
- **Changement du mot de passe admin** : modifiez `ADMIN_PASSWORD` puis executez `php artisan db:seed --class=AdminUserSeeder`.
