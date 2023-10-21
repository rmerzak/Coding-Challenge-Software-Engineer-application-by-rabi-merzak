install:
	docker compose exec app composer install
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
create-project:
	mkdir -p src
	docker compose build
	docker compose up -d
	docker compose exec app composer create-project --prefer-dist laravel/laravel .
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
	@make migrate
up:
	docker compose up
build:
	docker compose build
remake:
	@make destroy
	@make install
stop:
	docker compose stop
down:
	docker compose down
down-v:
	docker compose down --remove-orphans --volumes
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
ps:
	docker compose ps
logs:
	docker compose logs
log-db:
	docker compose logs db
web:
	docker compose exec web bash
app:
	docker compose exec app bash
migrate:
	docker compose exec app php artisan migrate
fresh:
	docker compose exec app php artisan migrate:fresh --seed
create:
	docker compose exec app php artisan create:product
test:
	docker compose exec app php artisan test
cache:
	docker compose exec app composer dump-autoload -o
	@make optimize
	docker compose exec app php artisan event:cache
	docker compose exec app php artisan view:cache
cache-clear:
	docker compose exec app composer clear-cache
	@make optimize-clear
	docker compose exec app php artisan event:clear
db:
	docker compose exec db bash
seed:
	docker compose exec app php artisan db:seed --class=CategoriesTableSeeder
	docker compose exec app php artisan db:seed --class=ProductsTableSeeder
	docker compose exec app php artisan db:seed --class=CategoryProductsTableSeeder
sql:
	docker compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'
