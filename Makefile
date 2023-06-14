start:
	sudo docker-compose up -d
up:
	sudo docker-compose up
build:
	sudo docker-compose build
stop:
	sudo docker-compose stop
down:
	sudo docker-compose down
php_bash:
	docker exec -it laravel_vue_php bash
db_bash:
	docker exec -it laravel_vue_mysql bash
generate:
	./vendor/bin/doctrine-migrations migrations:generate
migrate:
	./vendor/bin/doctrine-migrations migrations:migrate	
docker migrate:
	sudo docker exec -it laravel_vue_php ./vendor/bin/doctrine-migrations migrate

	
