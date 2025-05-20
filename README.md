# PHP CRUD API Generator

Expose your MySQL/MariaDB database as a secure, flexible, and instant REST-like API.  
Features optional authentication (API key, Basic Auth, JWT, OAuth-ready),  
OpenAPI (Swagger) docs, and zero code generation.

---

## 🚀 Features

- Auto-discovers tables and columns
- Full CRUD endpoints for any table
- Configurable authentication (API Key, Basic Auth, JWT, or none)
- OpenAPI (Swagger) JSON endpoint for instant docs
- Clean PSR-4 codebase
- PHPUnit tests and extensible architecture

---

## 📦 Installation

```bash
composer create-project yourvendor/php-crud-api-generator
```

---

## ⚙️ Configuration

Copy and edit config files:

```bash
cp config/db.example.php config/db.php
cp config/api.example.php config/api.php
```

Edit `config/db.php`:

```php
return [
    'host' => 'localhost',
    'dbname' => 'your_database',
    'user' => 'your_db_user',
    'pass' => 'your_db_password',
    'charset' => 'utf8mb4'
];
```

Edit `config/api.php`:

```php
return [
    'auth_enabled' => false, // true to require authentication
    'auth_method' => 'apikey', // 'apikey', 'basic', 'jwt', 'oauth'
    'api_keys' => ['changeme123'], // API keys for 'apikey'
    'basic_users' => ['admin' => 'secret'], // Users for 'basic' and 'jwt'
    'jwt_secret' => 'YourSuperSecretKey',
    'jwt_issuer' => 'yourdomain.com',
    'jwt_audience' => 'yourdomain.com',
    'oauth_providers' => [
        // 'google' => ['client_id' => '', 'client_secret' => '', ...]
    ]
];
```

---

## 🔐 Authentication Modes

- **No auth:** `'auth_enabled' => false`
- **API Key:** `'auth_enabled' => true, 'auth_method' => 'apikey'`  
  Client: `X-API-Key` header or `?api_key=...`
- **Basic Auth:** `'auth_method' => 'basic'`  
  Client: HTTP Basic Auth
- **JWT:** `'auth_method' => 'jwt'`  
  1. `POST /index.php?action=login` with `username` and `password` (from `basic_users`)
  2. Use returned token as `Authorization: Bearer <token>`
- **OAuth (future):** `'auth_method' => 'oauth'`  
  (Implement provider logic as needed)

---

## 📚 API Endpoints

All requests go through `public/index.php` with `action` parameter.

| Action    | Method | Usage Example                                               |
|-----------|--------|------------------------------------------------------------|
| tables    | GET    | `/index.php?action=tables`                                 |
| columns   | GET    | `/index.php?action=columns&table=users`                    |
| list      | GET    | `/index.php?action=list&table=users`                       |
| read      | GET    | `/index.php?action=read&table=users&id=1`                  |
| create    | POST   | `/index.php?action=create&table=users` (form POST)         |
| update    | POST   | `/index.php?action=update&table=users&id=1` (form POST)    |
| delete    | POST   | `/index.php?action=delete&table=users&id=1`                |
| openapi   | GET    | `/index.php?action=openapi`                                |
| login     | POST   | `/index.php?action=login` (JWT only)                       |

---

## 🤖 Example `curl` Commands

```sh
curl http://localhost/index.php?action=tables
curl -H "X-API-Key: changeme123" "http://localhost/index.php?action=list&table=users"
curl -X POST -d "username=admin&password=secret" http://localhost/index.php?action=login
curl -H "Authorization: Bearer <token>" "http://localhost/index.php?action=list&table=users"
curl -u admin:secret "http://localhost/index.php?action=list&table=users"
```

---

## 🛡️ Security Notes

- **Enable authentication for any public deployment!**
- Never commit real credentials—use `.gitignore` and example configs.
- Restrict DB user privileges.

---

## 🧪 Running Tests

```bash
./vendor/bin/phpunit
```

---

## 🗺️ Roadmap

- RESTful route aliases (`/users/1`)
- OAuth2 provider integration
- More DB support (Postgres, SQLite)
- Pagination, filtering, relations

---

## 📄 License

MIT

---

## 🙌 Credits

Built by [Your Name](https://github.com/BitsHost). PRs/issues welcome!