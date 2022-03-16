## DashHound Project

DashHound is a game forum website which allows different users to share their gameplay experiences and interact with each other.

Its a friendly resource allowing people to communicate, rate and share game screenshots as well as browse posts which are from verified publishers like official game authors.

## Components

* [PHP] - Most of my project features backend coding to make the functionality work, Using mainly the MVC Framework: Laravel
* [HTML] - Key to most front end development making the page look the way it does.
* [Vue.js] - Feature used for javascript to make features look more fascinating.

## Ownership

DashHound is owned by http://www.jlcwd.me and is based in regards to a University Project whilst self taught Laravel as the used language.

## Contents of Project

The project is primarily based on the Laravel MVC Framework for PHP and uses the built in Vue.js for javascript attributes. All contents in terms of unique features are all built and coded by myself. I do not take credit for the features that came with Laravel and only take credit for edited features from myself.

## Custom Features implemented
* [Ticket-System] - The ticket system is a support system for users to be able to communicate with community staff without having to use emails.
* [Forums] - A custom written forum is the central hub for DashHound, allowing users to communicate and interact with each other about various topics.

# Installation
First clone the repo into your local project. 
```
git clone https://github.com/JamieCee20/DashHound
```

Next we need to setup the dependencies. We do this via composer. Make sure you are in the project directly in your terminal before running this.
```
composer install
```

## Setup your local database

Make a copy of the .env.example file and rename it to .env. Inside your .env file, you need to fill out the DB_DATABASE, DB_USERNAME and DB_PASSWORD fields to match with your local database setup.

## Generate a local key
```
php artisan key:generate
```

## Run your migrations
Next we need to occupy the database with our required tables, we do this with artisan.
```
php artisan migrate
```

## Start local server
Finally to view our server, we use artisan to spin up a localhost server
```
php artisan serve
```

