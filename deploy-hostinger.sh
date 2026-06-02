#!/bin/bash

# Script de déploiement sécurisé pour Cybcraft sur Hostinger
# Usage: ./deploy-hostinger.sh <hostname> <username> <password> <database>

set -e  # Exit on error

HOSTNAME=$1
USERNAME=$2
PASSWORD=$3
DATABASE=$4
REMOTE_PATH="/home/${USERNAME}/public_html/cybcraft"

if [ -z "$HOSTNAME" ] || [ -z "$USERNAME" ] || [ -z "$PASSWORD" ] || [ -z "$DATABASE" ]; then
    echo "Usage: ./deploy-hostinger.sh <hostname> <username> <password> <database>"
    echo ""
    echo "Exemple: ./deploy-hostinger.sh hostinger.com user pass db123456"
    exit 1
fi

echo "================================================"
echo "🚀 CYBCRAFT DEPLOYMENT SCRIPT - HOSTINGER"
echo "================================================"
echo ""
echo "Cible: $HOSTNAME"
echo "Utilisateur: $USERNAME"
echo "Base de données: $DATABASE"
echo ""
read -p "Continuer ? (y/n) " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    exit 1
fi

echo ""
echo "📦 ÉTAPE 1: Préparer les fichiers..."
npm run build > /dev/null 2>&1
rm -rf build-temp 2>/dev/null
mkdir -p build-temp

echo "📋 ÉTAPE 2: Créer l'archive de déploiement..."
git archive --format=tar.gz HEAD -o build-temp/cybcraft-deploy.tar.gz \
    --exclude=node_modules \
    --exclude=vendor \
    --exclude=.env \
    --exclude=storage/logs \
    --exclude=bootstrap/cache \
    --exclude=build-temp \
    --exclude=DEPLOYMENT_HOSTINGER.md \
    --exclude=deploy-hostinger.sh \
    --exclude=.git

echo "✅ Archive créée: build-temp/cybcraft-deploy.tar.gz"
echo ""
echo "📤 ÉTAPE 3: Transférer vers Hostinger..."
echo ""
echo "Commandes SSH à exécuter sur Hostinger:"
echo "========================================="
echo ""
echo "cd ${REMOTE_PATH}"
echo ""
echo "# Créer une sauvegarde"
echo "cp -r . ./backup_\$(date +%Y%m%d_%H%M%S)"
echo "mysqldump -u${USERNAME} -p${PASSWORD} ${DATABASE} > backups/db_\$(date +%Y%m%d_%H%M%S).sql"
echo ""
echo "# Extraire et installer"
echo "tar -xzf cybcraft-deploy.tar.gz"
echo "composer install --no-dev --optimize-autoloader"
echo "npm install && npm run build"
echo ""
echo "# Configuration"
echo "cp .env.example .env"
echo "php artisan key:generate"
echo "php artisan config:cache"
echo ""
echo "# Migrations (SÛRE - pas de perte de données)"
echo "php artisan migrate --force"
echo ""
echo "# Permissions"
echo "chmod -R 755 storage bootstrap/cache"
echo "php artisan storage:link"
echo ""
echo "# Vérification"
echo "php artisan migrate:status"
echo ""
echo "========================================="
echo ""
read -p "Appuyez sur ENTER pour fermer..."
