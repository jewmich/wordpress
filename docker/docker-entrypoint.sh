#!/bin/bash

set -euo pipefail

apt-get update
apt-get install -qq -y unzip git subversion # needed by composer
apt-get install -qq -y vim-tiny

# Custom entrypoint that only handles installing Wordpress. We don't need any of the environment
# setting stuff (we have our own version of wp-config.php that stores secrets outside Git) or the DB
# creation logic (which the Docker MySQL image handles for us).

if ! [ -e index.php -a -e wp-includes/version.php ]; then
	echo >&2 "WordPress not found in $(pwd) - copying now..."
	if [ "$(ls -A)" ]; then
		echo >&2 "WARNING: $(pwd) is not empty - press Ctrl+C now if this is an error!"
		( set -x; ls -A; sleep 10 )
	fi
	tar cf - --one-file-system -C /usr/src/wordpress . | tar xf -
	echo >&2 "Complete! WordPress has been successfully copied to $(pwd)"
	if [ ! -e .htaccess ]; then
		# NOTE: The "Indexes" option is disabled in the php:apache base image
		cat > .htaccess <<-'EOF'
			# BEGIN WordPress
			<IfModule mod_rewrite.c>
			RewriteEngine On
			RewriteBase /
			RewriteRule ^index\.php$ - [L]
			RewriteCond %{REQUEST_FILENAME} !-f
			RewriteCond %{REQUEST_FILENAME} !-d
			RewriteRule . /index.php [L]
			</IfModule>
			# END WordPress
		EOF
		chown www-data:www-data .htaccess
	fi
fi

# Add xdebug
pecl install xdebug
docker-php-ext-enable xdebug
echo -e "xdebug.profiler_enable_trigger=on\nxdebug.profiler_output_dir=/var/www/html" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

cd ..

# Need to make writable php error log 
touch php-errors.log
chown www-data:www-data php-errors.log

if ! [ -e composer.phar ]; then
	# Install composer (taken from https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md)
	EXPECTED_SIGNATURE=$(curl -s https://composer.github.io/installer.sig)
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")

	if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
	then
	    >&2 echo 'ERROR: Invalid installer signature'
	    exit 1
	fi

	php composer-setup.php --quiet
	rm composer-setup.php
fi


php composer.phar install
cd -

exec "$@"
