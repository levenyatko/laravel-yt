# Laravel Youtube project

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/livewire-%234e56a6.svg?style=for-the-badge&logo=livewire&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

## 🚀 Installation

1. Clone the repository
2. Copy environment files and update environment variables
   - Main project env file
   - Laravel-specific env file in the laravel-app folder
```bash
  cp .env.example .env
```
3. Start Docker containers
```bash
  docker-compose up -d
```
4. Install PHP dependencies
```bash
  docker-compose exec php composer install
```
5. Run laravel
```bash
    docker-compose run --rm artisan key:generate
    docker-compose run --rm artisan migrate
	docker-compose run --rm artisan storage:link
	cd laravel-app
	npm install && npm run dev
```
7. Run queue
```bash
    docker-compose run --rm artisan queue:work --tries=3
```
8. Access the application http://localhost
