# vim: set tabstop=8 softtabstop=8 noexpandtab:
.PHONY: install
install:
	@docker-compose exec php composer install
	@docker-compose exec php ./bin/console doctrine:database:create --if-not-exists
	@docker-compose exec php ./bin/console doctrine:schema:update  --force
	@docker-compose exec client npm install

.PHONY: client
client:
	@docker-compose exec client npm run dev

.PHONY: import
import:
	@docker-compose exec php ./bin/console app:import

.PHONY: test
test:
	@docker-compose exec php ./bin/console doctrine:database:create --if-not-exists --env test
	@docker-compose exec php ./bin/console doctrine:schema:update  --force --env test
	@docker-compose exec php ./bin/phpunit

.PHONY: autofix
autofix:
	@docker-compose exec php composer autofix
	@docker-compose exec client npm run autofix

.PHONY: up
up:
	@docker-compose up -d

.PHONY: stop
stop:
	@docker-compose stop
