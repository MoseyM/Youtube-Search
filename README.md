# Youtube Search #

## Overview ##

This application's purpose is to provide a way to search Youtube for videos using a user-provided term. Its simple in execution and intuitive.

## Tech Info ##
 - Laravel 5.7
 - Youtube Data API

## Setup ##
1. Clone the repository.
    ```
    git clone https://github.com/MoseyM/Youtube-Search.git
    ```
2. Create a MySQL user and set permissions
3. Create a MySQL database to be used with the application
4. Copy .env.example and rename it to .env
    ```
    cp .env.example .env
    ```
5. Update the following envioronment variables with the newly-created MySQL credentials within your .env file
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    ```
6. Update `YOUTUBE_API_KEY`
7. Migrate(no need to seed unless you want)
    ```
    php artisan migrate
    ```
8. Create a user to use within the application (can be done within tinker)
    ```
    $ php artisan tinker 
    $ use App\User;
    $ User::create([
        'name'  => 'whatever',
        'email' => 'whatever@whatever.com',
        'password' => bcrypt('whatever')
    ]);

9. Access the site.