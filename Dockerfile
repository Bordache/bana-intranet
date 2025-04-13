# Utiliser PHP 8 avec Apache
FROM php:8.2-apache

# Installer les extensions PHP requises
RUN docker-php-ext-install pdo pdo_mysql

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le dossier de travail
WORKDIR /var/www/html/

# Copier les fichiers du projet
COPY /home/bana-server/Laravel-project/bana-intranet /var/www/html/bana-intranet

# Vérifier que les fichiers sont bien copiés
RUN ls -la /var/www/html/bana-intranet/

# Modifier les permissions pour éviter les erreurs
RUN chown -R www-data:www-data /var/www/html/bana-intranet  && chmod -R 755 /var/www/html/bana-intranet

# Supprimer le cache Composer
RUN composer clear-cache

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
