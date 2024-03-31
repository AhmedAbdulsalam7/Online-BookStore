# Laravel Online-BookStore API

## About Project

This project is a Laravel-based Online-BookStore API that includes user authentication with Laravel Passport and basic CRUD functionalities for managing users and Books.

## Table of Contents

- Installation.
- Authentication.
- API Endpoints.
  Books
  Cart Item
  Orders
- Add To Cart
- Checkout
- Usage

## Installation

1. Clone the repository:
   git clone AhmedAbdulsalam7/Online-BookStore
2. cd Online-BookStore
3. Install dependencies:
   composer install
4. Set up your environment file:
   you need include SECRET_KEY in .env file, tou can generate secret key using openssl rand -base64 32 also you need (cp .env.example .env)
5. create database like mysql or postgreSQL then create user for the database and grant all Privilege
6. after create database you should fill the the info of connection atribute in .env file
7. php artisan passport:install
8. run php artisan serve

## Authentication

To use the API, you need to register and authenticate with Laravel Passport.

### Registration Endpoint:

POST http://127.0.0.1:8000/api/register

### Login Endpoint:

POST http://127.0.0.1:8000/api/login

## API Endpoints

### Books

#### Show All Books

GET http://127.0.0.1:8000/api/books


#### Get Book by ID:

GET http://127.0.0.1:8000/api/books/2


#### Create Book:

POST http://127.0.0.1:8000/api/books


#### Update Book:

PUT http://127.0.0.1:8000/api/books/1


#### Delete Book:

DELETE http://127.0.0.1:8000/api/books/3

### Cart-Item

#### Get Cart-Item:

GET http://127.0.0.1:8000/api/cart-items

#### Get Cart-Item By Id:

GET http://127.0.0.1:8000/api/cart-items/6

#### Delete Cart-Item:

DELETE http://127.0.0.1:8000/api/cart-items/6

### Orders

#### Checkout:

POST http://127.0.0.1:8000/api/checkout

#### Get User Order:

GET http://127.0.0.1:8000/api/orders

### Add To Cart:

#### Add-To-Cart

POST http://127.0.0.1:8000/api/cart/add-to-cart

## Usage

Register a user using the /api/register endpoint.

Login to obtain an access token using the /api/login endpoint.

Use the obtained access token to authenticate requests to protected endpoints.

Explore and interact with the API using the provided CRUD endpoints.

