DC := docker exec -it
FPM := $(DC) interview-task
FPM_SU := $(DC) --user=root interview-task
NODE := $(DC) node yarn
ARTISAN := $(FPM) php artisan
MYSQL := $(DC) -T mysql
CURRENT_UID := $(shell id -u)

.PHONY: ssh ssh-su

ssh:
	@$(FPM) bash

ssh-su:
	@$(FPM_SU) bash

start:
	docker compose -f docker-compose.yml up -d


stop:
	docker compose -f docker-compose.yml down
