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

5. Run artisan seed command:
```bash
php artisan db:seed
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

Testing:
-------

For testing api additional test database is required. 
Fill in appropriate values for test database in .env  
To run api test use the following command:
```bash
./vendor/bin/phpunit tests/Api/
```

API:
----
All the responses are returned as JSON.  
Only application/json Accept header is appropriate

**Example:**

```bash
  curl -XGET --header "Accept: application/xml" http://localhost:8000/api/customers
```
  Response:
  ```json
  {
    "success": false,
    "data": null,
    "errors": {
      "headers": "Accept must be application/json"
    },
    "meta": null
  }
  ```
For body application requires to get json.
Header Content-Type: application/json is required.
 
Each json response consists of the following keys:

* *success*  - the result of an operation.  
* *data*     - the response data.
* *errors* - an array of errors
* *meta* - meta information that may contain pagination items and etc.


POST */api/customers* - create a new customer

**Example**:  

```bash
curl -XPOST -H "Content-Type:application/json"  http://localhost:8000/api/customers
```

JSON input
```json
{
	"email":"customer@customer.com",
	"first_name":"John",
	"last_name":"McClain",
	"gender":"male",
	"country":"US"
}
```

JSON output:  
```json
{
  "success": true,
  "data": {
    "bonus_percent": 14,
    "email": "customer@customer.com",
    "first_name": "John",
    "last_name": "McClain",
    "gender": "male",
    "country": "US",
    "updated_at": "2017-04-01 14:22:02",
    "created_at": "2017-04-01 14:22:02",
    "id": 1
  },
  "errors": null,
  "meta": null
}
```

GET */api/customers?limit={n}&offset={n}* - get list of customers.   
Limit and offset query parameters are optional.

GET */api/customers/{id}* - get a specific customer by id. 
Response contains a current customer's balance and bonuse

**Example**

```bash
curl -XGET  http://localhost:8000/api/customers/1
```

JSON output:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "email": "customer@customer.com",
    "first_name": "John",
    "last_name": "McClain",
    "gender": "male",
    "country": "US",
    "created_at": "2017-04-01 14:22:02",
    "balance": "144.44",
    "bonus_percent": 14,
    "bonus": "6.44"
  },
  "errors": null,
  "meta": null
}
```

PATCH */api/customers/{id}* - update customer's personal info.
  

POST */api/customers/{id}/deposit* - make a deposit operation

**Example**

```bash
curl -XPOST http://localhost:8000/api/customers/1/deposit
```

JSON input:
```json
{
	"amount":"46"
}
```
JSON output:
```json
{
  "success": true,
  "data": {
    "id": 3,
    "customer_id": 1,
    "amount": "46.00",
    "currency": "USD",
    "status": "complete",
    "created_at": "2017-04-01 17:26:43",
    "updated_at": "2017-04-01 17:26:43"
  },
  "errors": null,
  "meta": null
}
```

POST */api/customers/{id}/withdraw* - make a withdrawal operation.

GET */api/transactions?limit={n}&offset={n}* - get list of transactions. 

GET */api/reports?days={n}* - get daily customer reports. 
 By default api takes a report for the last seven days. By
 using query params it is allowed to changed this value.
 
**Example**

```bash
curl -XGET http://localhost:8000/api/reports
```

JSON output:

```json
{
  "success": true,
  "data": [
    {
      "date": "2017-04-01",
      "country": "BY",
      "unique_customers": 1,
      "number_of_deposits": 6,
      "total_amount_of_deposit": "276.00",
      "number_of_withdrawal": 2,
      "total_amount_of_withdrawal": "20.00"
    },
    {
      "date": "2017-04-01",
      "country": "US",
      "unique_customers": 1,
      "number_of_deposits": 3,
      "total_amount_of_deposit": "138.00",
      "number_of_withdrawal": 2,
      "total_amount_of_withdrawal": "20.00"
    },
    {
      "date": "2017-03-31",
      "country": "BY",
      "unique_customers": 1,
      "number_of_deposits": 2,
      "total_amount_of_deposit": "92.00",
      "number_of_withdrawal": 0,
      "total_amount_of_withdrawal": "0.00"
    },
    {
      "date": "2017-03-30",
      "country": "BY",
      "unique_customers": 1,
      "number_of_deposits": 1,
      "total_amount_of_deposit": "46.00",
      "number_of_withdrawal": 0,
      "total_amount_of_withdrawal": "0.00"
    }
  ],
  "errors": null,
  "meta": {
    "total": 4,
    "count": 4,
    "limit": 50,
    "offset": 0
  }
}
```