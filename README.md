
---

# URL Shortener (API + SPA)

A self-hosted URL shortener built with a Laravel-based REST API and a modern SPA frontend.

---

## Features

* Shorten long URLs into clean, shareable links
* Fast SPA frontend for smooth user experience
* RESTful API for external clients and mobile apps
* Google OAuth authentication support
* Android companion app available

---

## Repositories

* Web/API: [https://github.com/tajimz/url-shortener-spa](https://github.com/tajimz/url-shortener-spa)
* Android App: [https://github.com/tajimz/url-shortener-android](https://github.com/tajimz/url-shortener-android)

---

## Deployment Guide

### Requirements

* PHP 8.3+
* Composer
* Node.js & NPM
* MySQL / MariaDB

---

### Installation

#### 1. Clone repository

```bash
git clone https://github.com/tajimz/url-shortener-spa.git
cd url-shortener-spa
```

#### 2. Install PHP dependencies

```bash
composer install --optimize-autoloader --no-dev
```

#### 3. Install frontend dependencies

```bash
npm install
```

#### 4. Build assets

```bash
npm run build
```

If server has limited resources:

```bash
RAYON_NUM_THREADS=1 npm run build
```

#### 5. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure database and Google OAuth credentials inside `.env`.

#### 6. Database migration

```bash
php artisan migrate:fresh
```

⚠️ This will erase existing database data.

---

## API Integration

The API is designed for external applications and mobile clients.

For reference implementation, see the Android companion app:
[https://github.com/tajimz/url-shortener-android](https://github.com/tajimz/url-shortener-android)

---

## License

© 2026 Tajim. All rights reserved.

This project is not licensed for use, copying, modification, or redistribution without explicit written permission.

If you want to use, host, or publish this project on any domain or platform, you must contact the author first:

Contact: [com.tajim@gmail.com](mailto:com.tajim@gmail.com)

---

## Contributing

Pull requests are not accepted without prior discussion.

---

