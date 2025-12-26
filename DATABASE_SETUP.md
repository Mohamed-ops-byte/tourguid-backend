# Database Setup Commands

## Create Database

Run this in your MySQL client (phpMyAdmin, MySQL Workbench, or command line):

```sql
CREATE DATABASE tourguid_backend CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## Verify Database

```sql
SHOW DATABASES LIKE 'tourguid_backend';
```

## Grant Permissions (if needed)

If you have a specific MySQL user (not root):

```sql
GRANT ALL PRIVILEGES ON tourguid_backend.* TO 'your_username'@'localhost';
FLUSH PRIVILEGES;
```

## After Database is Created

1. Make sure `.env` has correct credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tourguid_backend
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

2. Run migrations:
```bash
cd "c:\Users\Mohamed\Desktop\myprojects\TourGuid Test Full\backend"
php artisan migrate
```

Expected output:
```
INFO  Preparing database.
Creating migration table ........................... 25ms DONE

INFO  Running migrations.
2014_10_12_000000_create_users_table ............... 55ms DONE
2014_10_12_100000_create_password_reset_tokens_table 42ms DONE
2019_08_19_000000_create_failed_jobs_table ......... 38ms DONE
2019_12_14_000001_create_personal_access_tokens_table 47ms DONE
2025_12_22_094408_create_services_table ............ 32ms DONE
2025_12_22_094426_create_gallery_categories_table .. 29ms DONE
2025_12_22_094427_create_gallery_items_table ....... 41ms DONE
2025_12_22_094427_create_videos_table .............. 30ms DONE
```

## Verify Tables

```sql
USE tourguid_backend;
SHOW TABLES;
```

You should see:
- cache
- cache_locks
- failed_jobs
- gallery_categories
- gallery_items
- jobs
- job_batches
- migrations
- password_reset_tokens
- personal_access_tokens
- services
- sessions
- users
- videos

## Seed Sample Data (Optional)

You can insert some test data:

```sql
-- Insert sample service
INSERT INTO services (title, icon, description, features, price, `order`, is_active, created_at, updated_at)
VALUES (
  'Private Tours',
  '👤',
  'Exclusive personalized tours designed just for you',
  '["Flexible itinerary", "Personal attention", "Custom pace", "Private transportation"]',
  'From $150/day',
  1,
  1,
  NOW(),
  NOW()
);

-- Insert gallery category
INSERT INTO gallery_categories (name, slug, `order`, is_active, created_at, updated_at)
VALUES ('Historical', 'historical', 1, 1, NOW(), NOW());

-- Insert video
INSERT INTO videos (title, description, url, platform, duration, `order`, is_active, created_at, updated_at)
VALUES (
  'Pyramids Tour Highlights',
  'Amazing tour of the pyramids',
  'https://www.youtube.com/embed/dQw4w9WgXcQ',
  'youtube',
  '03:45',
  1,
  1,
  NOW(),
  NOW()
);
```

## Check Data

```sql
SELECT * FROM services;
SELECT * FROM gallery_categories;
SELECT * FROM videos;
```

## Common Issues

### Issue: "Access denied for user"
**Solution**: Check username and password in `.env`

### Issue: "Database does not exist"
**Solution**: Run the CREATE DATABASE command above

### Issue: "SQLSTATE[HY000] [2002] Connection refused"
**Solution**: Make sure MySQL server is running
```bash
# Check MySQL status (Windows)
net start | findstr MySQL

# Start MySQL if needed
net start MySQL80  # or your MySQL service name
```

### Issue: SQLite driver error
**Solution**: Already fixed in `.env` - using MySQL instead

## Reset Database (if needed)

To start fresh:

```bash
php artisan migrate:fresh
```

This will drop all tables and re-run migrations.

## Backup Database

```bash
mysqldump -u root -p tourguid_backend > backup.sql
```

## Restore Database

```bash
mysql -u root -p tourguid_backend < backup.sql
```
