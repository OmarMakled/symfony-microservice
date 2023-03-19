php composer.phar require --dev symfony/maker-bundle
php composer.phar require guzzlehttp/guzzle
php composer.phar require orm
php composer.phar require --dev orm-fixtures
composer require --dev symfony/test-pack

bin/console doctrine:schema:update  --force --env test
bin/console doctrine:database:create --env test