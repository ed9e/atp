.SILENT:
.DEFAULT_GOAL := help 
## Colors
COLOR_RESET   = \033[0m
COLOR_INFO    = \033[32m
COLOR_COMMENT = \033[33m

## Help
help:
	printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	printf " make [target]\n\n"
	printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	awk '/^[a-zA-Z\-\_0-9\.@]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf " ${COLOR_INFO}%-16s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

               ###############
               # Environment #
               ###############

say_hello:
	@echo "Hello World"

## clear-cache
clear-cache:
	php bin/console cache:clear --no-warmup

## list ./bin/concole list
list:
	php bin/console list --no-debug

## dump-html
dump-html:
	./bin/console server:dump --format=html > dump.html

## dump
dump:
	./bin/console server:dump

## db-show-changes
db-show-changes:
	./bin/console doctrine:schema:update --dump-sql

## db-apply
db-apply:
	./bin/console doctrine:schema:update --force

## make entity
entity:
	./bin/console make:entity

## make fixtures-append
fixtures-append:
	php bin/console doctrine:fixtures:load --append

## make migration
migration:
	./bin/console make:migration

## make doctrine:migrations:migrate
migrate:
	./bin/console doctrine:migrations:migrate

## make make:entity --regenerate
regenerate:
	./bin/console make:entity --regenerate --overwrite

## make controller
controller:
	./bin/console make:controller

## make garmin:calendar:import
garmin-calendar-import:
	php bin/console garmin:calendar:import

## analiza statyczna PHPStanem
phpstan: 
	./vendor/bin/phpstan analyse

## .js i .css kompilacja
encore-watch:
	yarn encore dev --watch


