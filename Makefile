install:
	cp .env.example .env
	docker-compose up -d --build
	docker-compose exec app composer install
	docker-compose exec app cp .env.example .env
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate:fresh --seed
	docker-compose exec app npm install && npm run dev
install-vue:
	docker-compose exec app npm install -D vue
	docker-compose exec app npm install -D vue-template-compiler
	docker-compose exec app npm run dev
build:
	docker-compose build --no-cache
up:
	docker-compose up -d
ps:
	docker-compose ps
stop:
	docker-compose stop
restart:
	docker-compose restart
down:
	docker-compose down --rmi all -v
app:
	docker-compose exec app bash
cache-clear:
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear
seed:
	docker-compose exec app composer dump-autoload
	docker-compose exec app php artisan migrate:fresh --seed
