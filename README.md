# Laravel Youtube project

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?logo=laravel&logoColor=white)
![Sail](https://img.shields.io/badge/sail-%23FF2D20.svg?logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/livewire-%234e56a6.svg?logo=livewire&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/postgresql-4169e1?logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?logo=docker&logoColor=white)

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
4. Install Laravel Dependencies and build front-end assets
```bash
  composer install
  npm install && npm run dev
```
5. Generate applicaiton key, run migrations and publish storage link
```bash
  php artisan key:generate
  php artisan migrate
  php artisan storage:link
```
6. Run queue
```bash
  php artisan queue:work --tries=3
```
7. Access the application http://localhost
