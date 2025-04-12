# Finances 🌟

This guide explains how to set up this proyect
## Prerequisites

Before you begin, ensure you have the following installed:
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/downloads)

## Getting Started

### 1. Clone the Repository

```bash
# Clone the repository
git clone https://github.com/monicaGY/control-finanzas.git finances

# Navigate to the project directory
cd finances
```

### 2. Environment Setup

```bash
# Copy the example env file
cp .env.example .env

# Update the following variables in .env file
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

# Add this variable in .env file
DB_MAIN=smartcash

```

### 3. Build and Run Docker Containers

```bash
# Build and start the containers
docker-compose up -d

# Install PHP dependencies
docker-compose exec app composer install


# Generate application key
docker-compose exec app php artisan key:generate
```

**Permission Issues**
   ```bash
   # Fix storage permissions
   docker-compose exec laravel-vue-app chown -R www-data:www-data storage
   docker-compose exec laravel-vue-app chmod -R 775 storage
   ```

### 4. Node Setup

```bash
# Install node packages
docker-compose exec app npm install

# (Optional) build the frontend
docker-compose exec app npm run build
```

### 5. Database Setup

```bash
# Run database migrations
docker-compose exec laravel-vue-app php artisan migrate

# Seed the database
docker-compose exec laravel-vue-app php artisan db:seed
```

## Available Services

| Service | Port |
|---------|------|
| Application | `http://localhost:8081` |
| MySQL | `3306` |

### 5. Finances - login
**User:** `stefania@example.com`  
**Password:** `password123!`
