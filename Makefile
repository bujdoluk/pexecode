up:
	docker compose up -d --build

down:
	docker compose down

install:
	docker compose exec php composer install -d /var/www/html

logs:
	docker compose logs -f

reset:
	docker compose down -v
	docker compose up -d --build
	sleep 3
	docker compose exec php composer install -d /var/www/html
