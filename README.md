
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

---

## 🔌 API Documentation

Base URL:

```
https://<your-domain>/api
```

Authentication uses **Laravel Sanctum**.

Send token in header:

```
Authorization: Bearer <token>
```

---

## 🔓 Public Endpoints

### 🔐 Login

`POST /api/login`

Request:

```json
{
  "email": "string",
  "password": "string",
  "device_name": "string"
}
```

---

### 🔐 Google Social Login

`POST /api/social-login`

```json
{
  "provider": "google",
  "id_token": "string",
  "device_name": "string"
}
```

---

### 📝 Register

`POST /api/register`

```json
{
  "name": "string",
  "email": "string",
  "password": "string",
  "device_name": "string"
}
```

---

### ✂️ Create Short URL

`POST /api/urls`

```json
{
  "long_url": "string",
  "short_code": "string (optional)",
  "password": "string (optional)"
}
```

⚠️ Auth users can set `short_code` and `password`.
Guests cannot.

---

### ⚙️ App Settings

`GET /api/app-settings`

---

## 🔒 Authenticated Endpoints

(Require `auth:sanctum`)

### 👤 Get User

`GET /api/me`

---

### ✏️ Update Profile

`PATCH /api/me`

```json
{
  "name": "string",
  "old_password": "string",
  "new_password": "string"
}
```

---

### 🚪 Logout

`POST /api/logout`

---

### 📊 URLs

#### List URLs

`GET /api/urls`

#### Get single URL

`GET /api/urls/{id}`

#### Delete URL

`DELETE /api/urls/{id}`

---

### 📧 Email Verification

`POST /api/verification/send`

---

## 📌 Notes

* Uses **Sanctum token authentication**
* Short URLs support optional password protection
* Reserved `short_code` values are blocked
* Ownership checks applied for all URL actions

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

