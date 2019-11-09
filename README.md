# Symfony4 Example

Update .evn with correct values.

## How to run on local

```bash
# install dependencies
composer install

# create database
php bin/console doctrine:database:create

# run migration
php bin/console doctrine:migrations:migrate

# run local server
php bin/console server:run
```
