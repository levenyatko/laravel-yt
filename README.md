# Laravel Youtube project

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/livewire-%234e56a6.svg?style=for-the-badge&logo=livewire&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

## ⚙️ Installation

Follow the steps below to set up the project locally using Docker.

### Prerequisites

Make sure you have the following installed on your system:

- Docker
- Docker Compose
- Git

### Steps

1. Clone the repository
2. Copy environment file and update variables
```bash
  cp .env.example .env
```
3. Start Docker containers
```bash
  docker-compose up -d
```
4. Install Laravel Dependencies
```bash
  docker compose exec workspace bash
  composer install
  npm install
  npm run dev
```
5. Generate applicaiton key, run migrations and publish storage link
```bash
  docker compose exec workspace bash
  php artisan key:generate
  php artisan migrate
  php artisan storage:link
```
6. Run queue
```bash
  docker compose exec workspace bash
  php artisan queue:work --tries=3
```
7. Access the application http://localhost

## 📚 Resources & External Projects

- **Laravel Docker Examples Project**  
  🔗 https://github.com/dockersamples/laravel-docker-examples/

  📌 Used to create Docker containers.
