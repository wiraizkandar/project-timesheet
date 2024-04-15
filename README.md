## Project Timesheet
This project is based on laravel 10 Framework with functionalities on project timesheet submission.
This project harnesses the robust capabilities of the Laravel 10 Framework, focusing specifically on streamlining project timesheet submission functionalities. Leveraging the fundamental features of the Laravel framework stack, this application provides a solid foundation for efficient time management within project workflows. This application using basic laravel framework with stack 
- MySql
- Blade
- Tailwind
- PHPunit Test

### Start application

1. Start Application Sercvices In Docker
```PHP
docker compose up -d
```

2. Enable Permission For Storage
```PHP
docker exec -it php-timesheet sh
chmod -R 777 /var/www/html/storage
```
3. Install PHP Package via Composer

```PHP
docker compose run composer install
```

4. Run Database Migration And Seed Demo User

```PHP
docker compose run artisan migrate --seed
```

5. Login Demo Account
```PHP
http://127.0.0.1:3000/

Demo User:
email : userdemo@gmail.com
password : password123

```

### To Run Test Case
```PHP
docker compose run artisan test
```

### To Run Composer Command
```PHP
docker compose run composer --help
```


### To Run NPM build
```PHP
docker compose run npm build
```


