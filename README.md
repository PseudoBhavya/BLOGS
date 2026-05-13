# ✦ BlogYaari — Premium Blog Management System

[![Laravel](https://img.shields.io/badge/Laravel-13.7-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php)](https://www.php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-v4-38B2AC?style=flat-square&logo=tailwindcss)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

BlogYaari is a production-grade, cinematic Blog Management System built with **Laravel 13**, **Tailwind CSS v4**, **Vite**, and **jQuery AJAX**. Designed as a modern SaaS publishing platform, it features a premium aesthetic, smooth motion design, and a lightning-fast user experience.

---

## 📋 Table of Contents

- [Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Project Structure](#-project-structure)
- [Running the Project](#-running-the-project)
- [Database](#-database)
- [Admin Credentials](#-admin-credentials)
- [Testing](#-testing)
- [Deployment](#-deployment)
- [Troubleshooting](#-troubleshooting)

---

## ✨ Key Features

### Frontend (Public)

- **Cinematic Hero Section**: High-quality video background with glassmorphism overlays
- **Floating Dashboard Preview**: Real custom-coded interactive UI mockups
- **AJAX Filtering & Search**: Instant results without page reloads using debounced search and category filters
- **Premium Typography**: Medium-inspired reading experience with Instrument Serif & Inter fonts
- **Reading Progress**: Interactive progress bar and estimated reading time
- **Fully Responsive**: Optimized for all devices from iPhone to 4K monitors
- **Dynamic Blog Listings**: Category-based filtering, sorting, and pagination

### Admin Panel

- **Stripe-Inspired Dashboard**: Modern sidebar navigation, glassmorphism cards, and analytics
- **Full Blog CRUD**: Manage titles, slugs, featured images, and rich content
- **Category Management**: Customizable colors and icons for content organization
- **Analytics Overview**: Track total views, published posts, and category engagement
- **Modern Forms**: Floating labels, image previews, and validation error handling
- **User Management**: Admin and user role management
- **Media Management**: Upload and manage featured images and assets

---

## 🛠️ Tech Stack

### Backend

| Technology            | Version | Purpose                |
| --------------------- | ------- | ---------------------- |
| **Laravel Framework** | ^13.7   | Core web framework     |
| **PHP**               | ^8.3+   | Server-side language   |
| **MySQL**             | 8.0+    | Relational database    |
| **Composer**          | Latest  | PHP dependency manager |

### Frontend

| Technology          | Version | Purpose                     |
| ------------------- | ------- | --------------------------- |
| **Blade Templates** | Latest  | Server-side templating      |
| **Tailwind CSS**    | v4.3.0  | Utility-first CSS framework |
| **Vite**            | ^8.0.0  | Next-gen build tool         |
| **jQuery**          | Latest  | DOM manipulation & AJAX     |
| **Lucide Icons**    | Latest  | Icon library                |

### Development & Testing

| Technology       | Version  | Purpose                  |
| ---------------- | -------- | ------------------------ |
| **PHPUnit**      | ^12.5.12 | PHP unit testing         |
| **Faker**        | ^1.23    | Generate fake data       |
| **Mockery**      | ^1.6     | Mocking library          |
| **Laravel Pint** | ^1.27    | PHP code style fixer     |
| **Concurrently** | ^9.0.1   | Run multiple npm scripts |

---

## 📋 Prerequisites

### System Requirements

- **PHP**: 8.3 or higher
- **Node.js**: 18.0 or higher
- **npm**: 9.0 or higher
- **Composer**: 2.0 or higher
- **MySQL**: 8.0 or higher (or any compatible database)

### Installation Check

```bash
# Verify PHP
php --version

# Verify Composer
composer --version

# Verify Node.js and npm
node --version
npm --version

# Verify MySQL
mysql --version
```

---

## 🚀 Installation

### Step 1: Clone Repository

```bash
git clone <repository-url>
cd JobYaari
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install NPM Dependencies

```bash
npm install
```

### Step 4: Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 5: Database Configuration

Edit `.env` file and update database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogyaari
DB_USERNAME=root
DB_PASSWORD=
```

### Step 6: Run Migrations & Seed Data

```bash
# Create database tables
php artisan migrate

# (Optional) Seed with sample data
php artisan migrate:fresh --seed
```

### Step 7: Build Frontend Assets

```bash
# Production build
npm run build

# Or development with hot reload
npm run dev
```

---

## 📁 Project Structure

```
JobYaari/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # API and web controllers
│   │   ├── Middleware/            # HTTP middleware
│   │   └── Requests/              # Form request validation
│   ├── Models/
│   │   ├── User.php               # User model
│   │   ├── Blog.php               # Blog post model
│   │   └── Category.php           # Category model
│   └── Providers/
│       └── AppServiceProvider.php # Service provider
│
├── bootstrap/
│   ├── app.php                    # Application bootstrap
│   ├── providers.php              # Provider registration
│   └── cache/                     # Cache files
│
├── config/
│   ├── app.php                    # Application configuration
│   ├── auth.php                   # Authentication config
│   ├── database.php               # Database config
│   ├── filesystems.php            # File storage config
│   ├── mail.php                   # Mail configuration
│   ├── cache.php                  # Cache configuration
│   └── [other configs]/           # Additional configurations
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2024_01_01_000001_add_fields_to_users_table.php
│   │   ├── 2024_01_01_000002_create_categories_table.php
│   │   └── 2024_01_01_000003_create_blogs_table.php
│   ├── factories/
│   │   └── UserFactory.php        # User model factory
│   └── seeders/
│       ├── UserSeeder.php         # Seed users
│       ├── CategorySeeder.php     # Seed categories
│       ├── BlogSeeder.php         # Seed blog posts
│       └── DatabaseSeeder.php     # Main seeder
│
├── public/
│   ├── index.php                  # Application entry point
│   ├── robots.txt                 # SEO robots file
│   └── build/                     # Vite compiled assets
│       ├── assets/                # JS/CSS bundles
│       ├── manifest.json          # Asset manifest
│       └── fonts-manifest.json    # Font manifest
│
├── resources/
│   ├── css/
│   │   └── app.css                # Main stylesheet (Tailwind)
│   ├── js/
│   │   └── app.js                 # Main JavaScript file
│   └── views/
│       ├── welcome.blade.php      # Welcome page
│       ├── home.blade.php         # Home page
│       ├── admin/                 # Admin panel views
│       ├── blogs/                 # Blog views
│       ├── layouts/               # Layout templates
│       └── partials/              # Reusable components
│
├── routes/
│   ├── web.php                    # Web routes
│   └── console.php                # Console commands
│
├── storage/
│   ├── app/
│   │   ├── public/                # Public storage
│   │   └── private/               # Private storage
│   ├── framework/
│   │   ├── cache/                 # Cache storage
│   │   ├── sessions/              # Session storage
│   │   ├── views/                 # Compiled views
│   │   └── testing/               # Testing storage
│   └── logs/                      # Application logs
│
├── tests/
│   ├── TestCase.php               # Base test case
│   ├── Feature/
│   │   └── ExampleTest.php        # Feature tests
│   └── Unit/
│       └── ExampleTest.php        # Unit tests
│
├── vendor/                        # Composer dependencies (auto-generated)
├── node_modules/                  # NPM dependencies (auto-generated)
│
├── artisan                        # Laravel CLI entry point
├── composer.json                  # PHP dependencies
├── package.json                   # NPM dependencies
├── vite.config.js                 # Vite configuration
├── phpunit.xml                    # PHPUnit configuration
├── .env.example                   # Environment template
├── .env                           # Environment variables (local)
├── .gitignore                     # Git ignore rules
├── README.md                      # This file
└── LICENSE                        # MIT License
```

### Key Directories Explained

| Directory    | Purpose                                             |
| ------------ | --------------------------------------------------- |
| `app/`       | Application business logic, models, and controllers |
| `database/`  | Database migrations, factories, and seeders         |
| `resources/` | Frontend views, styles, and JavaScript              |
| `routes/`    | Route definitions for the application               |
| `public/`    | Public-facing files and compiled assets             |
| `storage/`   | User uploads, cache, and session files              |
| `tests/`     | Automated test files                                |
| `config/`    | Application configuration files                     |
| `bootstrap/` | Framework bootstrap files                           |

---

## 🎯 Running the Project

### Option 1: Simple Development Server

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server (for hot reload)
npm run dev
```

Visit: **http://localhost:8000**

### Option 2: All-in-One Development (Recommended)

```bash
# Runs Laravel server, queue listener, logs, and Vite dev server concurrently
composer run dev
```

### Option 3: Production Build

```bash
# Build frontend assets
npm run build

# Start server
php artisan serve
```

---

## 🗄️ Database

### Tables Structure

#### `users`

- id (Primary Key)
- name
- email (Unique)
- password
- email_verified_at
- remember_token
- timestamps

#### `categories`

- id (Primary Key)
- name
- slug (Unique)
- description
- icon
- color
- timestamps

#### `blogs`

- id (Primary Key)
- user_id (Foreign Key → users)
- category_id (Foreign Key → categories)
- title
- slug (Unique)
- excerpt
- content
- featured_image
- views_count
- is_published
- published_at
- timestamps

### Seed Sample Data

```bash
# Fresh migrations with seed data
php artisan migrate:fresh --seed

# Or just seed existing database
php artisan db:seed
```

---

## 🔑 Admin Credentials

After running migrations and seeders, use these credentials:

| Field        | Value                               |
| ------------ | ----------------------------------- |
| **URL**      | `http://localhost:8000/admin/login` |
| **Email**    | `admin@blogyaari.com`               |
| **Password** | `password`                          |

> **⚠️ Important**: Change these credentials in production!

---

## 🧪 Testing

### Run All Tests

```bash
# Run all tests
php artisan test

# Run with verbose output
php artisan test --verbose

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run with coverage
php artisan test --coverage
```

### Code Style

```bash
# Check code style with Pint
./vendor/bin/pint --check

# Fix code style automatically
./vendor/bin/pint
```

---

## 📦 Deployment

### Render / DigitalOcean

1. Connect GitHub repository to Render/DigitalOcean
2. Set Build Command:
    ```bash
    composer install && npm install && npm run build
    ```
3. Set Start Command:
    ```bash
    php artisan serve --host=0.0.0.0 --port=$PORT
    ```
4. Configure Environment Variables:
    ```
    APP_KEY=<generated-key>
    DB_HOST=<database-host>
    DB_DATABASE=<database-name>
    DB_USERNAME=<db-user>
    DB_PASSWORD=<db-password>
    ```

### Shared Hosting (InfinityFree, Bluehost, etc.)

1. Zip project (exclude `node_modules/` and `vendor/`)
2. Upload to `public_html/`
3. Move contents of `public/` to root if required
4. Update `index.php` paths if needed
5. Create `.env` file in root with database credentials
6. Run migrations via terminal or control panel

### Docker Deployment

```dockerfile
FROM php:8.3-fpm
RUN apt-get update && apt-get install -y mysql-client
COPY . /var/www/html
WORKDIR /var/www/html
RUN composer install
RUN npm install && npm run build
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
```

---

## 🐛 Troubleshooting

### Common Issues

#### 1. **"No supported encrypter found"**

```bash
php artisan key:generate
```

#### 2. **Database Connection Error**

- Verify `.env` database credentials
- Ensure MySQL is running
- Check DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD

#### 3. **Permission Denied on storage/**

```bash
chmod -R 775 storage/ bootstrap/cache/
```

#### 4. **npm run build fails**

```bash
rm -rf node_modules package-lock.json
npm install
npm run build
```

#### 5. **Port 8000 Already in Use**

```bash
php artisan serve --port=8001
```

#### 6. **Vite Hot Module Replacement (HMR) Issues**

Update `vite.config.js`:

```javascript
export default defineConfig({
    server: {
        hmr: {
            host: "127.0.0.1",
            port: 5173,
        },
    },
});
```

---

## 📝 Environment Variables

Key environment variables in `.env`:

```env
APP_NAME="BlogYaari"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogyaari
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log
MAIL_HOST=smtp.mailtrap.io
```

---

## 📄 License

This project is open-source software licensed under the [MIT license](LICENSE).

---

## 👨‍💻 Development

Built for **PHP/Laravel Developer Internship Assessment**.

For questions or issues, please open an issue on the repository.

**Happy Coding! 🚀**
