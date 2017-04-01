Test Task
=========

Requirements:
-------------

**PHP** >= 7.0  
**MySQL** >= 5.7.15

Installed [composer](https://getcomposer.org/).

Installation:
-------------
1. Run composer install

```bash
composer install
```

2. Make a copy of .env.exmaple to .env
```bash
cp .env.example .env
```

3. Change database configuration according to your system in .env

4. Run artisan migrations:
```bash
php artisan migrate
```

Usage:
------

Run artisan server:
```bash
php artisan serve
```

By default it will run server on [http://localhost:8000](http://localhost:8000)  

To check if api works you may make ping request:
```bash
curl -XGET http://localhost:8000/api/ping
```

You should get the following response:
```bash
{"success":true,"data":{"message":"pong"},"errors":null,"meta":null}
```
By default debug mode is enabled and all the database queries will be logged 
under the property _debug in json response.

