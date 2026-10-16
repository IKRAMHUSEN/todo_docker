# 🐳 LaraTodo - Laravel 12 + MySQL + Docker

A beginner-friendly Laravel Todo application running entirely inside Docker with Nginx, PHP 8.2-FPM, and MySQL 8.0.

---

## 📋 Prerequisites

You **only** need these two tools installed on your computer:
- [Git](https://git-scm.com/)

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (must be running)
> 💡 **Note:** You do **not** need PHP, Composer, or MySQL installed on your local machine. Everything runs inside Docker!

---

## 🚀 Setup Instructions (Step-by-Step)

Follow these steps to run the project from scratch on any computer (Windows / Mac / Linux):

### 1. Clone the Repository
```bash
git clone https://github.com/IKRAMHUSEN/todo_docker.git laratodo
cd laratodo
```

---

### 2. Prepare Environment File (`.env`)
Copy the example environment file:

- **Windows (PowerShell):**
  ```powershell
  copy .env.example .env
  ```
- **Mac / Linux / Git Bash:**
  ```bash
  cp .env.example .env
  ```

Open `.env` and verify that the database credentials match Docker Compose:
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laratodo_db
DB_USERNAME=laratodo_user
DB_PASSWORD=laratodo_pass
```

> ⚠️ **Important:** `DB_HOST` must be `db` (the Docker service name), **not** `localhost` or `127.0.0.1`.

---

### 3. Build & Start Docker Containers
```bash
docker compose up -d --build
```
*This downloads Nginx and MySQL images, builds the custom PHP image, and starts all 3 containers in the background.*

---

### 4. Install PHP Dependencies (Composer)
```bash
docker compose exec app composer install
```

---

### 5. Generate Application Encryption Key
```bash
docker compose exec app php artisan key:generate
```

---

### 6. Run Database Migrations
```bash
docker compose exec app php artisan migrate
```

---

### 7. Set Folder Permissions
Ensure Laravel can write to `storage` and cache directories:
```bash
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
docker compose exec app chmod -R 775 storage bootstrap/cache
```

---

### 🎉 All Done! Open the App

Open your browser and visit:
👉 **[http://localhost:8080](http://localhost:8080)**

---

## 🗄️ Accessing the Database (TablePlus / DBeaver / GUI)

You can connect to MySQL directly from your host machine:

| Field | Value |
|---|---|
| **Host** | `127.0.0.1` |
| **Port** | `3306` *(or `3307` if 3306 is occupied)* |
| **User** | `laratodo_user` (or `root`) |
| **Password** | `laratodo_pass` (or `rootpassword`) |
| **Database** | `laratodo_db` |



---

## ⚠️ Troubleshooting

### Port 3306 or 8080 already in use
If you get `address already in use` error when starting containers:
1. Open `docker-compose.yml`.
2. Change the host port (left number) under `ports:`:
   - For MySQL: change `"3306:3306"` to `"3307:3306"`
   - For Web: change `"8080:80"` to `"8081:80"`
3. Run `docker compose up -d` again.

### Permission Denied Error
If you see `The stream or file ".../laravel.log" could not be opened: Permission denied`:
```bash
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
docker compose exec app chmod -R 775 storage bootstrap/cache
```
