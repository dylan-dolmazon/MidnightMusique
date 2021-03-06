# MidnightMusique

## Créer Symfony project

- `$ docker exec www_docker_symfony composer create-project symfony/website-skeleton project`: créer un skelette du projet
- `$ sudo chown -R $USER ./`: monter les droits des fichiers

## Placer le terminal dans le shell du conteneur

- `$ docker exec -it www_docker_symfony bash`
- `/var/www: $ cd project`

## Créer une database

- `php bin/console doctrine:database:create`

### Créer une table

- `php bin/console make:entity`

### Exporter la table vers la database

- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`

## Importer database

- `php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity`
- `php bin/console make:entity --regenerate App`

## Créer un controller

- `php bin/console make:controller`

## Installer le projet

- `docker-compose up`
- `$ docker exec -it www_docker_symfony bash`
- `/var/www: $ cd project`
- `composer install`

## Charte graphique

- bleu-clair: #22b8e0
- bleu-foncé: #3355e3
- blanc-neige: #FEFEFE
