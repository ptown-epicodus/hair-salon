# Hair Salon

#### Independent project for Epicodus, 02.24.2017

#### By Patrick McGreevy

## Description

This Silex website features a simple database showing clients that belong to hair stylists.


## Setup/Installation Requirements
1. Set project root as working directory in CLI.
2. Run `$ composer install --prefer-source --no-interaction`.
3. Run `$ cd web`.
4. Run `$ php -S localhost:8000`.
5. Visit **`localhost:8000`** in web browser.

### Database Setup
```
$ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
> CREATE DATABASE hair_salon_test;
> USE hair_salon_test;
> CREATE TABLE stylists (id SERIAL PRIMARY KEY, name VARCHAR (255));
> CREATE TABLE clients (id SERIAL PRIMARY KEY, name VARCHAR (255), stylist_id INT);
> CREATE DATABASE hair_salon;
> USE hair_salon;
> CREATE TABLE stylists (id SERIAL PRIMARY KEY, name VARCHAR (255));
> CREATE TABLE clients (id SERIAL PRIMARY KEY, name VARCHAR (255), stylist_id INT);
```


## Technologies Used

HTML

CSS

Bootstrap

PHP

Silex

Twig

Composer

JSON


## Known Bugs

_No known bugs or issues_

### License

Copyright (c) 2017 _**Patrick McGreevy**_

This software is licensed under the MIT license.
