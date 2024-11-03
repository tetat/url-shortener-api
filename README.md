# URL Shortener API

This is a URL shortener api application where registered user can create a short link for a long url.

## Documentation

### Version 1

#### Register a new user

-   Method: `POST`
-   Endpoint:

```bash
http://127.0.0.1:8000/api/v1/register
```

-   Request body: You have to register with `name`, `email`, and `password`.
-   Response
    -   201 Created.
    -   422 Validation error.

#### User login

-   Method: `POST`
-   Endpoint:

```bash
http://127.0.0.1:8000/api/v1/login
```

-   Request body: You have to login with `email`, and `password`.
-   Response
    -   200 Ok.
    -   401 Authentication fails.
    -   422 Validation error.

#### User can create short link

-   Method: `POST`
-   Endpoint:

```bash
http://127.0.0.1:8000/api/v1/urls/
```

-   Request header:
    -   Authorization: Bearer {token}
-   Request body: Key must be `originalUrl` and value will be your `url`.
-   Response
    -   201 Created.
    -   401 Unauthorized.
    -   422 Validation error.

#### User can see his/her created all links with view count.

-   Method: `GET`
-   Endpoint:

```bash
http://127.0.0.1:8000/api/v1/users/{id}/urls
```

-   Request header:
    -   Authorization: Bearer {token}
-   Response
    -   200 Ok.
        ```bash
        [
            {
                "url": "http://127.0.0.1:8000/api/v2/urls/p0u9d1",
                "originalUrl": "https://laravel.com/docs/11.x/authorization#authorizing-actions-via-gates",
                "views": 3
            }
        ]
        ```
    -   401 Unauthorized.

#### Short Link (view)

-   Method: `GET`
-   Endpoint:

```bash
http://127.0.0.1:8000/api/v1/urls/p0u9d1
```

-   Response
    -   200 Ok.
    -   404 Short link is invalid or does not exist

### Version 2

All the previous endpoint will be same but only view count will be recorded. Endpoint must be need `v2` for example,

```bash
http://127.0.0.1:8000/api/v2/urls/p0u9d1
```

## Installation

First, clone this repository:

```bash
git clone https://github.com/tetat/url-shortener-api.git
```

Switch to the repository folder:

```bash
cd url-shortener-api
```

Install all dependencies using Composer:

```bash
composer install
```

Copy the `.env.example` file and make the required configuration changes in the `.env` file:

```bash
cp .env.example .env
```

Generate a new application key:

```bash
php artisan key:generate
```

Run the database migrations (set the database connection in `.env` before migrating):

```bash
php artisan migrate
```

Start the local development server:

```bash
php artisan serve
```
