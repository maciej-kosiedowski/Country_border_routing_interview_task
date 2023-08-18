## Introduction
Hi,
I'm Maciej Kosiedowski and this is repository with recurrent task. 
It's simple task to return information if requested country has border with another country. 
Data to data need to execute this project comes from `https://raw.githubusercontent.com/mledoze/countries/master/countries.json`
In project stored under `storage/app/countries.json`

#### Why I choose Laravel instead Symfony? 
I`m working with both frameworks, but personally prefer Laravel for better sugar syntax, Arr and Str helpers. 
Anyway I'm able to work in both frameworks :) 

## How to set up project
I prefer working on docker environmental, so i Created docker image with php8.1. Server on Nginx and DB on Mysql
Docker environment is copied from my other project and it`s the reason why has some not necessary services for this project.
In order to run this project you need have docker environmental prepared already on your host machine.

Commands to run project:
```
cp .env.example .env
docker compose build
docker compose up -d
```
Containers should exist, and now we can install other dependencies inside docker container
```
make ssh <- connect to php container
composer install
npm install
```
After successfully execute above commends you should be able to perform request to `/routing/{origin}/{destination}` via browser or postman


## Testing
For testing purpose I choose phpunit framework. 
In more series project unit testing will be more extended combined with mutation testing.

test structure:
- Feature <- Api endpoint tests
- Unit <- tests for services
I internally "forgot" about tests for Resource to limit scope of work for this interview project


## Linters
Project is using Laravel Pint (PHP-CS-Fixer under the hood) and phpStan
To run tools u can type
```
vendor/bin/pint
vendor/bin/phpstan analyse
```
in project root directory
