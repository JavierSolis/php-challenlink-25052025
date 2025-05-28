# .gitpod.Dockerfile
FROM gitpod/workspace-full:latest 
# Desinstalar la versión predeterminada de PHP (si es diferente y necesitas una limpia)
# Reemplaza 'php8.2' con la versión que tenga Gitpod por defecto si no es 8.2
# RUN sudo apt-get remove -yq php8.2

# Añadir el PPA de Ondrej Sury para versiones de PHP actualizadas
# Este PPA es la forma estándar de obtener diferentes versiones de PHP en Debian/Ubuntu
RUN sudo add-apt-repository ppa:ondrej/php -y
RUN sudo apt-get update -y

# Instalar la versión de PHP deseada (por ejemplo, PHP 8.1 o PHP 7.4)
# Si quieres PHP 8.1
# RUN sudo apt-get install -y php8.1 php8.1-cli php8.1-common php8.1-curl php8.1-mbstring php8.1-xml php8.1-zip php8.1-fpm

# Si quieres PHP 7.4
RUN sudo apt-get install -y php7.4 php7.4-cli php7.4-common php7.4-curl php7.4-mbstring php7.4-xml php7.4-zip php7.4-fpm

# Configurar la versión de PHP por defecto para la CLI
# Cambia 'php8.1' por la versión que instalaste
RUN sudo update-alternatives --set php /usr/bin/php7.4

# Instalar Composer para la nueva versión de PHP
RUN curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Limpiar caché de apt
RUN sudo rm -rf /var/lib/apt/lists/*

# Puedes añadir otras extensiones PHP o herramientas aquí si las necesitas
# RUN sudo apt-get install -y php8.1-xdebug

USER gitpod