I used Laravel Lumen for this project.

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. 

Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

Backend setup

by command prompt run this command to clone the repository:
selected/path/ git clone https://github.com/alaashehadeh/getyourguide.git

then run the following command to install the packages:
selected/path/getyourguide/ composer update

I create php artisan command to get the result run the following code:
selected/path/getyourguide/ php artisan availableProduct {start datetime} {end datetime} {traveller number}

for example:

php artisan availableProduct 2017-11-23T19:30 2016-08-08 5

for my code structure I usually use: repository service pattern mvc

for this project there is no database so i didnt use repositories and models.

but i keep the classes on this structure to can know how i usually work on larger projects.

there is two types of services:

- connector services (usually used for web services)
- core services as dependancy injection at the core controllers

I use static functions mainly for DTO and other helper classes like time functions as well