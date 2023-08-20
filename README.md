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
I prefer working on docker environmental, so I created docker image with php8.1 with server on nginx. 
In order to run this project you need have docker environmental prepared already on your host machine.

Commands to run project:
```
cp .env.example .env
docker compose build
docker compose up -d
```
Containers should exist, and now we can install other dependencies inside docker container
```
make ssh <- connect to php container or (docker exec -it interview-task bash)
composer install
npm install
```
After successfully execute above commends you should be able to perform request to `localhost/routing/{origin}/{destination}` via browser or postman


## Testing
For testing purpose I choose phpunit framework. 
In more series project unit testing will be more extended combined with mutation testing.

test structure:
- Feature <- Api endpoint tests
- Unit <- tests for services

Note:
It's only interview task and I don't have a lot of time in current weekend, so I wrote unit testing only to show How I will do that :) 


## Linters
Project is using Laravel Pint (PHP-CS-Fixer under the hood) and phpStan
To run tools u can type
```
vendor/bin/pint
vendor/bin/phpstan analyse
```
in project root directory


# Scope of task
```
Backend Developer Test 
Your task is to create a simple service in PHP using the framework of your choice (Symfony is preferred), that is able to calculate any possible land route from one country to another. The objective is to take a list of country data in JSON format and calculate the route by utilizing individual countries' border information. 
Specifications: 
● PHP using framework of your choice (Symfony is preferred)
● Data link: https://raw.githubusercontent.com/mledoze/countries/master/countries.json ● The application exposes REST endpoint /routing/{origin}/{destination} that returns a list of border crossings to get from origin to destination 
● Single route is returned if the journey is possible 
● Algorithm needs to be efficient 
● If there is no land crossing, the endpoint returns HTTP 400 
● Countries are identified by cca3 field in country data 
● HTTP request sample (land route from Czech Republic to Italy): 
○ GET /routing/CZE/ITA HTTP/1.0 : 
{ 
"route": ["CZE", "AUT", "ITA"] 
} 
```
