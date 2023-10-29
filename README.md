# Coding challenge 

## Quote of the day:

*Any organization that designs a system (defined broadly) will produce a design whose structure is a copy of the organization's communication structure.
-- Melvin Conway, 1968*

source: https://martinfowler.com/bliki/ConwaysLaw.html



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

create an ```.env``` file inside frontend-project:
```bash
API_BASE_URL=http://localhost/
```
to access the table check the link below:
http://localhost:8080/product

#### backend:
http://localhost
#### Adminer:
http://localhost:8081

```server: db```

```username: youcan```

```password: secret```

```Database: laravel```

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


### Command: Create Product
This Laravel console command, `create:product`, allows us to create a new product within our  application. It gathers information about the product, such as its name, description, price, and an optional image path. It also provides the ability to associate the product with one or more categories.
Before using this command, ensure you have an image downloaded in your `src` file in case you wanna add a product with an image.
### Usage
To use the `create:product` command, follow these steps:

```bash
$ make create
```
The command will guide you through the product creation process with the following prompts:

1. -   **Enter the product name:** Enter the name of the product.
    
	-   **Enter the product description:** Provide a description for the product.
    
	-   **Enter the product price:** Specify the price of the product.
    
	-   **Enter the path to the image file (leave empty if none):** Optionally, provide the path to an 			image file. If no image is available, simply press Enter.
2.  After entering the required information, you will be presented with a list of available categories. You can select one or more categories to associate with the product by entering a comma-separated list of category IDs when prompted.
    
3.  The command will attempt to create the product and associate it with the selected categories. If successful, it will display a success message and provide the product's details in JSON format.
    
4.  If an error occurs during the product creation process, an error message will be displayed, providing details about the issue.
![](https://github.com/rmerzak/Coding-Challenge-Software-Engineer-application-by-rabi-merzak/blob/main/impl/CreateCommand.png?raw=true)

### Frontend :

![](https://github.com/rmerzak/Coding-Challenge-Software-Engineer-application-by-rabi-merzak/blob/main/impl/tableProduct.png?raw=true)
![](https://github.com/rmerzak/Coding-Challenge-Software-Engineer-application-by-rabi-merzak/blob/main/impl/FormProduct.png?raw=true)
![](https://github.com/rmerzak/Coding-Challenge-Software-Engineer-application-by-rabi-merzak/blob/main/impl/AddedProduct.png?raw=true)
