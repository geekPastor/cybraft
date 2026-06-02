# Guide de déploiement sur Hostinger - Sans perte de données

## ⚠️ IMPORTANT : Avant de commencer

**Faire une sauvegarde complète de la base de données et des fichiers en ligne.**

```bash
# Sur Hostinger - Télécharger la base de données
mysqldump -u[USERNAME] -p[PASSWORD] [DATABASE_NAME] > backup_$(date +%Y%m%d_%H%M%S).sql

# Télécharger les fichiers critiques (images, fichiers uploadés)
scp -r user@hostinger.com:/home/user/cybcraft/storage/app/public ./backup/storage
```

---

## 📋 Étapes de déploiement SANS perte de données

### 1. **Préparer les fichiers localement**

```bash
cd /home/geek-pastor/Documents/cybcraft

# Nettoyer les fichiers temporaires
rm -rf node_modules
rm -rf vendor/composer/autoload_*.php

# Compiler les assets
npm run build

# Exporter le code (sans node_modules et vendor)
git archive --format=tar.gz HEAD -o cybcraft-deploy.tar.gz \
  --exclude=node_modules \
  --exclude=vendor \
  --exclude=.env \
  --exclude=storage/logs \
  --exclude=bootstrap/cache
```

### 2. **Connecter à Hostinger (via SSH ou cPanel)**

```bash
# Via SSH
ssh user@your-hostinger-domain.com

# Naviguer vers le dossier du projet
cd public_html/cybcraft  # ou votre chemin exact
```

### 3. **Sauvegarder la version actuelle** (CRITIQUE)

```bash
# Créer un backup complet
cd /home/user/cybcraft
cp -r . ./backup_$(date +%Y%m%d_%H%M%S)

# Ou avec la base de données
mysqldump -u[USERNAME] -p[PASSWORD] [DATABASE_NAME] > backups/db_$(date +%Y%m%d_%H%M%S).sql
```

### 4. **Déployer le nouveau code**

```bash
# Uploader le fichier tar.gz via SFTP ou cPanel
# Puis extraire :
tar -xzf cybcraft-deploy.tar.gz

# Installer les dépendances
composer install --no-dev --optimize-autoloader

# Installer les dépendances front
npm install && npm run build

# Copier le .env
cp .env.example .env

# Générer la clé si elle n'existe pas
php artisan key:generate

# Effacer les caches
php artisan config:cache
php artisan route:cache
```

### 5. **Exécuter les migrations** (préservation des données)

⚠️ **LES MIGRATIONS SONT SÉCURISÉES - Elles ajoutent seulement des colonnes nullables**

```bash
# Les migrations sont SANS PERTE DE DONNÉES :
# - custom_name (nullable)
# - custom_url (nullable)

php artisan migrate --force

# Vérifier que tout s'est bien passé
php artisan migrate:status
```

### 6. **Recréer le symlink de stockage**

```bash
# Supprimer l'ancien symlink s'il existe
rm public/storage 2>/dev/null

# Créer le nouveau
php artisan storage:link

# Vérifier
ls -la public/storage
```

### 7. **Permissions correctes**

```bash
# Donner les bonnes permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public/storage

# Donner les droits au serveur web
chown -R nobody:nogroup storage bootstrap/cache public/storage
# OU
chown -R www-data:www-data storage bootstrap/cache public/storage
```

### 8. **Vérifier que ça marche**

```bash
# Tester les migrations
php artisan migrate:status

# Vérifier les utilisateurs
php artisan tinker
# Puis dans tinker:
>>> \App\Models\User::count()

# Vérifier les images
>>> \App\Models\pictures::first()
```

### 9. **Configurer le .env pour la production**

```bash
# Éditer .env sur Hostinger
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

# Base de données (utiliser celle existante)
DB_DATABASE=votre_db_actuelle
DB_USERNAME=votre_user
DB_PASSWORD=votre_password

# Cache et session (optionnel mais recommandé)
CACHE_DRIVER=redis
SESSION_DRIVER=database
```

---

## ✅ Checklist de sécurité

- [ ] Sauvegarde DB faite avant migration
- [ ] Sauvegarde fichiers storage faite
- [ ] Migration exécutée sans erreur
- [ ] Symlink créé
- [ ] Permissions correctes
- [ ] Images affichées sur le profil
- [ ] Nouveaux utilisateurs peuvent ajouter réseaux personnalisés
- [ ] Anciens utilisateurs ne sont pas affectés
- [ ] Tests fonctionnels réussis

---

## 🔄 En cas de problème - ROLLBACK

```bash
# 1. Restaurer la base de données
mysql -u[USERNAME] -p[PASSWORD] [DATABASE_NAME] < backups/db_backup.sql

# 2. Restaurer les fichiers
rm -rf *
cp -r backup_DATE/* .

# 3. Redémarrer
```

---

## 📝 Différences principales avec la version actuelle

### Migrations ajoutées (SÛRES - ajout seulement)
- `custom_name` (varchar, nullable) - Nom du réseau social personnalisé
- `custom_url` (varchar, nullable) - URL du réseau social personnalisé

### Fichiers modifiés
- `app/Http/Controllers/ProfilController.php` - Meilleur mapping bio/description
- `app/Http/Controllers/StorageController.php` - Chemin de stockage corrigé
- `resources/views/welcome.blade.php` - Icônes FontAwesome + logos réseaux
- `resources/views/update.blade.php` - Champs pour réseau personnalisé
- `app/Models/reseau.php` - Ajout colonnes fillable

**Tous les changements sont rétrocompatibles et n'affectent pas les données existantes.**

---

## 📞 Support

En cas de problème sur Hostinger :
1. Vérifier les logs : `tail storage/logs/laravel.log`
2. Vérifier les permissions des fichiers
3. Contacter le support Hostinger pour les problèmes PHP/MySQL
4. Vérifier que PHP 8.1+ est activé
