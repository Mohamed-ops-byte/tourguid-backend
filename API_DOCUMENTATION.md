# Tourist Guide Backend API

Laravel REST API backend for the Tourist Guide portfolio website.

## Features

- **RESTful API** endpoints for all content management
- **Laravel Sanctum** authentication for admin panel
- **Image Upload** support with local storage
- **CORS** enabled for frontend communication
- **MySQL** database support

## Requirements

- PHP 8.2+
- Composer
- MySQL 5.7+ or MariaDB
- Node.js (optional, for asset compilation)

## Installation

### 1. Install Dependencies

```bash
composer install
```

### 2. Environment Setup

Copy `.env.example` to `.env` and configure:

```bash
cp .env.example .env
```

Update the following values:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tourguid_backend
DB_USERNAME=root
DB_PASSWORD=your_password

FILESYSTEM_DISK=public
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Create Database

Create a MySQL database named `tourguid_backend`:

```sql
CREATE DATABASE tourguid_backend CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public` for serving uploaded images.

### 7. Start Development Server

```bash
php artisan serve
```

API will be available at `http://localhost:8000`

## API Endpoints

### Public Endpoints (No Authentication)

#### Services
- `GET /api/services` - List all active services
- `GET /api/services/{id}` - Get single service

#### Gallery Categories
- `GET /api/gallery-categories` - List all categories
- `GET /api/gallery-categories/{id}` - Get category with items

#### Gallery Items
- `GET /api/gallery-items` - List all gallery items
- `GET /api/gallery-items?category_id={id}` - Filter by category
- `GET /api/gallery-items/{id}` - Get single item

#### Videos
- `GET /api/videos` - List all videos
- `GET /api/videos/{id}` - Get single video

### Authentication Endpoints

#### Register
```http
POST /api/register
Content-Type: application/json

{
  "name": "Admin User",
  "email": "admin@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

#### Login
```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password123"
}
```

Returns:
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": { ... },
    "token": "your-api-token"
  }
}
```

#### Logout
```http
POST /api/logout
Authorization: Bearer {token}
```

### Protected Endpoints (Require Authentication)

**All protected endpoints require the `Authorization: Bearer {token}` header.**

#### Services Management
- `POST /api/services` - Create service
- `PUT /api/services/{id}` - Update service
- `DELETE /api/services/{id}` - Delete service

**Create/Update Service Body:**
```json
{
  "title": "Private Tours",
  "icon": "👤",
  "description": "Personalized experiences...",
  "features": ["Flexible itinerary", "Personal attention"],
  "price": "From $150/day",
  "order": 1,
  "is_active": true
}
```

#### Gallery Categories Management
- `POST /api/gallery-categories` - Create category
- `PUT /api/gallery-categories/{id}` - Update category
- `DELETE /api/gallery-categories/{id}` - Delete category

**Create/Update Category Body:**
```json
{
  "name": "Historical",
  "order": 1,
  "is_active": true
}
```

#### Gallery Items Management
- `POST /api/gallery-items` - Create item (multipart/form-data)
- `POST /api/gallery-items/{id}` - Update item (multipart/form-data)
- `DELETE /api/gallery-items/{id}` - Delete item

**Create Gallery Item (multipart/form-data):**
```
gallery_category_id: 1
title: Pyramids Tour
description: Amazing pyramids visit
image: [file upload]
order: 1
is_active: true
```

#### Videos Management
- `POST /api/videos` - Create video
- `PUT /api/videos/{id}` - Update video
- `DELETE /api/videos/{id}` - Delete video

**Create/Update Video Body:**
```json
{
  "title": "Desert Safari Highlights",
  "description": "Exciting adventure...",
  "url": "https://www.youtube.com/embed/VIDEO_ID",
  "platform": "youtube",
  "duration": "02:10",
  "order": 1,
  "is_active": true
}
```

## Database Schema

### Services Table
- `id` - Primary key
- `title` - Service name
- `icon` - Emoji or icon identifier
- `description` - Service description
- `features` - JSON array of features
- `price` - Price string
- `order` - Display order
- `is_active` - Active status
- `created_at`, `updated_at`

### Gallery Categories Table
- `id` - Primary key
- `name` - Category name
- `slug` - URL-friendly slug
- `order` - Display order
- `is_active` - Active status
- `created_at`, `updated_at`

### Gallery Items Table
- `id` - Primary key
- `gallery_category_id` - Foreign key to categories
- `title` - Item title
- `description` - Item description
- `image_path` - Stored image path
- `order` - Display order
- `is_active` - Active status
- `created_at`, `updated_at`

### Videos Table
- `id` - Primary key
- `title` - Video title
- `description` - Video description
- `url` - YouTube/Vimeo embed URL
- `platform` - Platform type (youtube, vimeo, mp4)
- `duration` - Video duration string
- `order` - Display order
- `is_active` - Active status
- `created_at`, `updated_at`

## CORS Configuration

CORS is configured to allow requests from:
- `http://localhost:5173` (Vite default)
- `http://localhost:3000` (React default)
- Additional ports: 5174

You can modify allowed origins in `config/cors.php`.

## Image Storage

Images are stored in `storage/app/public/gallery/` and served via the symbolic link at `public/storage/gallery/`.

Images are automatically deleted when gallery items are removed.

## Response Format

All API responses follow this format:

**Success:**
```json
{
  "success": true,
  "data": { ... }
}
```

**Error:**
```json
{
  "success": false,
  "errors": { ... }
}
```

## Testing with Postman/Insomnia

1. **Register a user** via `/api/register`
2. **Login** to get your token via `/api/login`
3. **Set Authorization header**: `Bearer {your-token}`
4. **Make authenticated requests** to protected endpoints

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Configure proper database credentials
3. Set up proper CORS origins
4. Optimize:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Security Notes

- Change `APP_KEY` in production
- Use strong database passwords
- Configure proper CORS origins for production
- Enable HTTPS in production
- Set secure session cookies

## Frontend Integration

The frontend React app should:
1. Store the token from login response
2. Include `Authorization: Bearer {token}` header for protected routes
3. Use `http://localhost:8000/api` as the base URL

Example:
```javascript
const API_URL = 'http://localhost:8000/api';

// Login
const response = await fetch(`${API_URL}/login`, {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ email, password })
});

const { data } = await response.json();
localStorage.setItem('token', data.token);

// Protected request
const servicesResponse = await fetch(`${API_URL}/services`, {
  headers: {
    'Authorization': `Bearer ${localStorage.getItem('token')}`
  }
});
```

## Support

For issues or questions, please open an issue in the repository.
