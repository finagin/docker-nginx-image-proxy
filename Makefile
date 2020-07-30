include .env

.PHONY : docker-up
docker-up :
	@docker-compose -f .docker/compose.yml up -d --build --force-recreate --remove-orphans

.PHONY : docker-down
docker-down :
	@docker-compose -f .docker/compose.yml down

.PHONY : init
init : .env
init : composer-install
init : public/storage/30845deb719c61c0bb246ef8e5465cc9.jpg
init : docker-up
init :
	@composer install
	@echo 127.0.0.1 ${NGINX_HOST} | sudo tee -a /etc/hosts
	@echo "Project ready"

.PHONY : storage-link
storage-link : public/storage
storage-link :
	@echo "Public storage linked"

.PHONY : composer-install
composer-install : composer.phar
composer-install :
	@php composer.phar install


.env :
	@cp .env.example .env

composer.phar :
	@php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	@php -r "if (hash_file('sha384', 'composer-setup.php') === 'e5325b19b381bfd88ce90a5ddb7823406b2a38cff6bb704b0acc289a09c8128d4a8ce2bbafcd1fcbdc38666422fe2806') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
	@php composer-setup.php
	@php -r "unlink('composer-setup.php');"

public/storage/30845deb719c61c0bb246ef8e5465cc9.jpg : storage-link
public/storage/30845deb719c61c0bb246ef8e5465cc9.jpg :
	curl -sSL https://i.pinimg.com/originals/30/84/5d/30845deb719c61c0bb246ef8e5465cc9.jpg -o public/storage/30845deb719c61c0bb246ef8e5465cc9.jpg

public/storage :
	@ln -s ../storage/app/public public/storage
