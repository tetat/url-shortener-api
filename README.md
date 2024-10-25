# URL Shortener API

This is a URL shortener api application where registered user can create a short link for a long url.

## Features

### Users

-   User registration
-   User login
-   User can create short link
-   User can see his/her created all links with view count.

### Short Link

-   Anyone can use the short link

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

Install Sanctum API

```bash
php artisan install:api
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
