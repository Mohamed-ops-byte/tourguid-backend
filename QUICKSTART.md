# Quick Start Guide

## Prerequisites
1. PHP 8.2+ installed
2. Composer installed
3. MySQL server running

## Setup Steps

### 1. Create Database
```sql
CREATE DATABASE tourguid_backend CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Update .env file
The `.env` file is already configured. Only update if needed:
- `DB_DATABASE=tourguid_backend`
- `DB_USERNAME=root`
- `DB_PASSWORD=` (add your MySQL password)

### 3. Run Migrations
```bash
php artisan migrate
```

### 4. Start Server
```bash
php artisan serve
```

Backend will run at: http://localhost:8000

## First User Registration

Use Postman, Insomnia, or curl:

```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Admin",
    "email": "admin@tourguid.com",
    "password": "admin123",
    "password_confirmation": "admin123"
  }'
```

Save the returned token for authenticated requests.

## Test API

### Get Services (Public)
```bash
curl http://localhost:8000/api/services
```

### Create Service (Protected - needs token)
```bash
curl -X POST http://localhost:8000/api/services \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Private Tour",
    "description": "Exclusive tour experience",
    "price": "From $100",
    "is_active": true
  }'
```

## Storage Setup

The storage link is already created. Uploaded images will be available at:
`http://localhost:8000/storage/gallery/filename.jpg`

## CORS

CORS is configured for:
- http://localhost:5173 (Vite)
- http://localhost:3000 (Create React App)

## API Base URL

For frontend integration, use:
```
http://localhost:8000/api
```

## Complete Documentation

See [API_DOCUMENTATION.md](./API_DOCUMENTATION.md) for full API reference.
