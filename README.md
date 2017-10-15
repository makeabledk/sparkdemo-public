# Demo Laravel Spark app 

A super simple kanban style 'todo app' built in ~2 hours using 

- Laravel spark
- Laravel echo (with pusher js)
- Laravel passport

It's part of a MeetUp presentation hosted Oct 2017 in Aarhus, DK.

## Installation guide

First you must clone this repository. 

Next run following terminal commands

```
composer install
yarn install
yarn run dev

php artisan key:generate
php artisan migrate
php artisan passport:install
```

Fill in your *.env* file from the *.env.example* template.

**A valid Laravel Spark license is required for installation**