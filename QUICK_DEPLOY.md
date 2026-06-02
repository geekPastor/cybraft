# ⚡ COMMANDES ESSENTIELLES - DÉPLOIEMENT HOSTINGER

## 🔐 Sur votre local AVANT de déployer

```bash
# S'assurer que tout compile correctement
npm run build
composer install --no-dev

# Vérifier que la migration fonctionne
php artisan migrate --pretend

# Tester localement
php artisan serve
```

## 📤 SSH vers Hostinger

```bash
ssh user@votre-domaine.com
cd public_html/cybcraft
```

## 💾 SAUVEGARDE CRITIQUE (à exécuter EN PREMIER)

```bash
# Sauvegarder la base de données
mysqldump -u[USERNAME] -p[PASSWORD] [DATABASE] > db_backup_$(date +%Y%m%d_%H%M%S).sql

# Sauvegarder les fichiers
cp -r . ../cybcraft_backup_$(date +%Y%m%d_%H%M%S)

# Vérifier
ls -la ../cybcraft_backup*
ls -la db_backup*
```

## 📥 Déployer le code

```bash
# 1. Uploader via SFTP
# Utiliser FileZilla ou similaire pour uploader cybcraft-deploy.tar.gz

# 2. Extraire
tar -xzf cybcraft-deploy.tar.gz

# 3. Installer les dépendances
composer install --no-dev --optimize-autoloader
npm install && npm run build

# 4. Configurer
cp .env.example .env
php artisan key:generate

# 5. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 6. Recache (important pour la production)
php artisan config:cache
php artisan route:cache
```

## 🔄 Exécuter la migration

```bash
# IMPORTANT: Ceci est sûr - ajoute seulement des colonnes
php artisan migrate --force

# Vérifier que ça a marché
php artisan migrate:status
php artisan tinker
# Dans tinker: \App\Models\pictures::first()
# Exit: exit ou Ctrl+D
```

## 🔗 Symlink storage

```bash
# Créer le lien
php artisan storage:link

# Vérifier
ls -la public/storage
```

## 🔑 Permissions finales

```bash
# Donner les bonnes permissions
chmod -R 755 storage bootstrap/cache public/storage
chown -R nobody:nogroup storage bootstrap/cache public/storage
# OU (selon votre serveur)
chown -R www-data:www-data storage bootstrap/cache public/storage
```

## ✅ Vérification finale

```bash
# Tester l'app
php artisan tinker
# Tester les modèles:
>>> \App\Models\User::count()
>>> \App\Models\pictures::first()
>>> \App\Models\reseau::first()
>>> exit

# Vérifier les logs
tail -f storage/logs/laravel.log
```

## 🌐 Test en ligne

1. Aller sur votre domaine
2. Se connecter avec un compte test
3. Uploader une nouvelle image
4. Vérifier qu'elle s'affiche
5. Modifier le profil et ajouter un réseau personnalisé
6. Vérifier que tout fonctionne

## ⚠️ Si problème - Rollback rapide

```bash
# Restaurer la base de données
mysql -u[USERNAME] -p[PASSWORD] [DATABASE] < db_backup_DATE.sql

# Restaurer les fichiers
cd ..
rm -rf cybcraft
mv cybcraft_backup_DATE cybcraft

# Redémarrer
```

## 📋 Checklist finale

- [ ] Sauvegarde DB créée avant migration
- [ ] Sauvegarde fichiers créée avant migration
- [ ] Code déployé
- [ ] Dépendances installées
- [ ] .env configuré avec vraies credentials
- [ ] Migration exécutée sans erreur
- [ ] Symlink créé
- [ ] Permissions correctes
- [ ] Images anciennes affichées
- [ ] Nouvelles images s'affichent
- [ ] Anciens utilisateurs peuvent se connecter
- [ ] Bio des profils s'affiche
- [ ] Réseaux sociaux affichent les icônes
- [ ] Réseau personnalisé peut être ajouté

---

## 🆘 Support Hostinger

**Fichiers important:**
- `/home/user/.htaccess` - Configuration Apache (vérifier qu'il permet les symlinks)
- `php.ini` - Vérifier PHP 8.1+
- Permissions fichiers - Vérifier que www-data a accès

**Logs:**
- `tail storage/logs/laravel.log` - Erreurs Laravel
- SSH: `tail /var/log/error_log` - Erreurs serveur
- Dashboard Hostinger > Logs > Error Log

---

**Durée estimée: 20-30 minutes avec tests**
**Support: Hostinger chat ou support@hostinger.com pour les problèmes serveur**
