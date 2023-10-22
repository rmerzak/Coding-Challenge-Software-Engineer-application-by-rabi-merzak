# Coding challenge 

## Introduction

A simple product management system built with Laravel and Vue.js, created as a coding challenge for the position of Junior Software Engineer - Backend (PHP).

# Usage

# Project Setup()

1. Execute the following command
This command  is part of an installation and setup process for our web application, we have used Docker containers and Laravel. It installs dependencies, copies configuration files, generates application keys, sets up symbolic links, and adjusts directory permissions.
```bash
$ make install
```
#### frontend:
http://localhost:8080/product
#### backend:
http://localhost

### Container structures

```bash
├── app
├── web
└── db
└── adminer-app
└── vue-app
```
### app container
- Base image
  - [php](https://hub.docker.com/_/php):php:7.4-fpm-buster
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
POST /category | Create a category
GET /category  | Get a listing of category

# Implementation

![](https://github.com/rmerzak/Coding-Challenge-Software-Engineer-application-by-rabi-merzak/blob/main/impl/tableProduct.png?raw=true)
![](https://github.com/rmerzak/Coding-Challenge-Software-Engineer-application-by-rabi-merzak/blob/main/impl/FormProduct.png?raw=true)
![](https://github.com/rmerzak/Coding-Challenge-Software-Engineer-application-by-rabi-merzak/blob/main/impl/AddedProduct.png?raw=true)
