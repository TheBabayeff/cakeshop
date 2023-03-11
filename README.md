## Cake Shop Web Site 

### Builded with Laravel 10 


Install Laravel 10 

#### Change directory to Backend folder
 
    cd backend

Install all the dependencies using composer

    composer install or composer update

Copy the example env file and make the required configuration changes in the .env file
And Change APP_URL to Localhost:8000

    cp .env.example .env  

Generate a new application key

    php artisan key:generate

Publish storage for images.

    php artisan storage:link

Update the database configuration from your .env file

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cakeshop
    DB_USERNAME=root
    DB_PASSWORD=


Run the database migrations
(**Set the database connection in .env before migrating**)

    php artisan migrate

Start the development Server with this command

    php artisan serve

Your api is now hosted at http://localhost:8000

To get some initial data, you can run this command

```bash
php artisan db:seed
```
