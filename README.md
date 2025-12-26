# Tourist Guide Backend API

> **Complete Laravel REST API for the Tourist Guide Portfolio Website**

A fully functional Laravel backend that provides RESTful APIs for managing services, gallery images, videos, and admin authentication using Laravel Sanctum.

## 🚀 Quick Start

```bash
# 1. Create MySQL database
CREATE DATABASE tourguid_backend;

# 2. Update .env with your database credentials (if needed)

# 3. Run migrations
php artisan migrate

# 4. Start the server
php artisan serve
```

Your API is now running at `http://localhost:8000`

## 📚 Documentation

- **[QUICKSTART.md](./QUICKSTART.md)** - Fast setup in 5 minutes
- **[API_DOCUMENTATION.md](./API_DOCUMENTATION.md)** - Complete API reference with examples
- **[IMPLEMENTATION_SUMMARY.md](./IMPLEMENTATION_SUMMARY.md)** - What was built and how it works
- **[DATABASE_SETUP.md](./DATABASE_SETUP.md)** - Detailed database setup guide
- **[Postman_Collection.json](./Postman_Collection.json)** - Import into Postman for testing

## ✨ Features

✅ **RESTful API** - Clean, consistent endpoint structure  
✅ **Laravel Sanctum** - Token-based authentication  
✅ **Image Upload** - Handle gallery images with validation  
✅ **CORS Enabled** - Ready for React frontend  
✅ **MySQL Database** - Fully normalized schema  
✅ **Validation** - Input validation on all endpoints  
✅ **Relationships** - Gallery categories and items linked  
✅ **Consistent Responses** - Uniform JSON structure  

## 🗂️ What's Inside

### Models & Controllers
- **Services** - Tour services management (CRUD)
- **Gallery Categories** - Image categories with slugs
- **Gallery Items** - Images with upload support
- **Videos** - YouTube/Vimeo video links
- **Auth** - Register, Login, Logout

### API Endpoints

**Public (no auth required):**
```
GET  /api/services
GET  /api/gallery-categories
GET  /api/gallery-items
GET  /api/videos
```

**Authentication:**
```
POST /api/register
POST /api/login
POST /api/logout
```

**Protected (requires Bearer token):**
```
POST   /api/services
PUT    /api/services/{id}
DELETE /api/services/{id}

POST   /api/gallery-items  (multipart/form-data)
POST   /api/gallery-items/{id}
DELETE /api/gallery-items/{id}

... and more
```

## 🔧 Environment Setup

Key configurations in `.env`:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_DATABASE=tourguid_backend
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
```

## 🧪 Testing the API

### 1. Using Postman
Import `Postman_Collection.json` into Postman for ready-to-use requests.

### 2. Using curl

**Register:**
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

**Get Services:**
```bash
curl http://localhost:8000/api/services
```

## 🔗 Frontend Integration

Your React frontend should use:
- **Base URL**: `http://localhost:8000/api`
- **Auth Header**: `Authorization: Bearer {token}`

Example:
```javascript
const response = await fetch('http://localhost:8000/api/login', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ email, password })
});

const { data } = await response.json();
localStorage.setItem('token', data.token);
```

## 📦 Project Structure

```
backend/
├── app/
│   ├── Http/Controllers/     # API controllers
│   │   ├── AuthController.php
│   │   ├── ServiceController.php
│   │   ├── GalleryCategoryController.php
│   │   ├── GalleryItemController.php
│   │   └── VideoController.php
│   └── Models/               # Eloquent models
│       ├── User.php
│       ├── Service.php
│       ├── GalleryCategory.php
│       ├── GalleryItem.php
│       └── Video.php
├── config/
│   └── cors.php             # CORS configuration
├── database/migrations/      # Database schema
├── routes/
│   └── api.php              # API routes
└── storage/app/public/
    └── gallery/             # Uploaded images
```

## 🛡️ Security Features

- ✅ Password hashing (Bcrypt)
- ✅ Token-based auth (Laravel Sanctum)
- ✅ Input validation
- ✅ File upload validation
- ✅ CORS protection

## 🐛 Troubleshooting

**Database connection error?**
- Check MySQL is running
- Verify credentials in `.env`

**CORS issues?**
- Check `config/cors.php` has your frontend URL
- Clear config cache: `php artisan config:clear`

**Image upload not working?**
- Run: `php artisan storage:link`
- Check folder permissions

## 📖 Learn More

- Laravel Documentation: https://laravel.com/docs
- Laravel Sanctum: https://laravel.com/docs/sanctum
- REST API Best Practices: https://restfulapi.net/

## 📄 License

This project is open-source software licensed under the MIT license.
