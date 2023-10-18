# Coding challenge 

## Introduction

A simple product management system built with Laravel and Vue.js, created as a coding challenge for the position of Junior Software Engineer - Backend (PHP).

## Usage

### Backend install

1. Execute the following command

```bash
$ cd backend-project
$ make build
$ make up
$ make migrate


# or...

$ cd backend-project
$ docker compose build
$ docker compose up -d
$ docker compose exec app php artisan migrate
```

http://localhost

### Laravel setup

```bash
$ make install
```

### Container structures

```bash
├── app
├── web
└── db
```
### app container
- Base image
  - [php](https://hub.docker.com/_/php):8.2-fpm-bullseye
  - [composer](https://hub.docker.com/_/composer):2.6

### web container
- Base image
  - [nginx](https://hub.docker.com/_/nginx):1.25
### db container
- Base image
  - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0
### Endpoints

On the server we have the following controllers and endpoints:

Endpoint | Description
----------|------------
POST /products | Create a products
GET /products  | Get a listing of products
GET /products/:id | Get details about a post
DELETE /products/:id | Delete a products
POST /category | Create a category
GET /category  | Get a listing of category
## Frontend install

1. Execute the following command

```bash
$ cd frontend-project
$ npm install --force
$ npm run serve
```
http://localhost:8080