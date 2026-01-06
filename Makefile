QUEUE_TRIES := 3

build:
	docker-compose build --no-cache --force-rm
up:
	docker-compose up -d
stop:
	docker-compose stop
queuework:
	docker compose exec workspace php artisan queue:work --tries=$(QUEUE_TRIES)
install:
	docker compose exec workspace bash
	php artisan migrate
	php artisan storage:link
