# Job postings

* Laravel
* Mysql

# DEMO

https://job-postings-api.herokuapp.com/api/job/lt/

## How to deploy

1. Rename env.example to .env and put your MySql database credentials
1. Run "php artisan key:generate"
1. Run "php artisan migrate"
1. Run "php artisan jwt:secret"
* you need to make sure than you have composer and lamp stack installed on your machine

***
# Usage guide
***
#### Registration endpoint

``
POST {your-address}/api/auth/register
``

###### Send data as 'x-www-form-urlencoded' or form-data
```
name -> test [mandatory]
email -> test@test.com [mandatory]
password -> 123test [mandatory]
password_confirmation -> 123test [mandatory]
```
***
#### Login endpoint
``
POST {your-address}/api/auth/login
``
###### Send data as 'x-www-form-urlencoded' or form-data
```
email -> test@test.com [mandatory]
password -> 123test [mandatory]
```
***
After registration or login jwt token will be issued.
It can be used during store or update for authorization purpose.
Token will expire after hour then you will need to login again and get new token.
If you want to invalidate old token and get a new one you can refresh it with 'Refresh endpoint'
or completely discard it with "Logout endpoint".
***
#### Refresh endpoint
``
POST {your-address}/api/auth/refresh
``
###### Send your token as request header
```
Authorization -> bearer eyJ0eXAiOiJKV1QiLCJhbG
ciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N
0L2pvYnNBcGkvcHVibGljL2FwaS9hdXRoL2xvZ2luIiwia
WF0IjoxNjA2NDI5NDI2LCJleHAiOjE2MDY0MzMwMjYsIm5
iZiI6MTYwNjQyOTQyNiwianRpIjoiRHpRUHd0WWtJS0VWS
08yVCIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDB
hZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.nUFF7DaQ
T7P62DLheffDOh31OFzKKvBrTgMd1t2HZCc [mandatory]
```
***
#### Logout endpoint
``
POST {your-address}/api/auth/logout
``
###### Send your token as request header
```
Authorization -> bearer eyJ0eXAiOiJKV1QiLCJhbG
ciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N
0L2pvYnNBcGkvcHVibGljL2FwaS9hdXRoL2xvZ2luIiwia
WF0IjoxNjA2NDI5NDI2LCJleHAiOjE2MDY0MzMwMjYsIm5
iZiI6MTYwNjQyOTQyNiwianRpIjoiRHpRUHd0WWtJS0VWS
08yVCIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDB
hZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.nUFF7DaQ
T7P62DLheffDOh31OFzKKvBrTgMd1t2HZCc [mandatory]
```
***
#### Store endpoint
``
POST {your-address}/api/job/
``
###### Send your token as request header
```
Authorization -> bearer eyJ0eXAiOiJKV1QiLCJhbG
ciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N
0L2pvYnNBcGkvcHVibGljL2FwaS9hdXRoL2xvZ2luIiwia
WF0IjoxNjA2NDI5NDI2LCJleHAiOjE2MDY0MzMwMjYsIm5
iZiI6MTYwNjQyOTQyNiwianRpIjoiRHpRUHd0WWtJS0VWS
08yVCIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDB
hZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.nUFF7DaQ
T7P62DLheffDOh31OFzKKvBrTgMd1t2HZCc [mandatory]
```
###### Send data as 'x-www-form-urlencoded' or form-data
```
title[en] -> English title [mandatory]
title[lt] -> Lithuanian title [mandatory]
description[en] -> English description [mandatory]
description[lt] -> Lithuanian description [mandatory]
salary[en] -> English Salary [mandatory]
salary[lt] -> Lithuanim Salary [mandatory]
areas[lt][] -> Lithuanian Job area [optional * 5 entries] 
areas[en][] -> English Job area [optional * 5 entries] 
```
***
"Store endpoint" and "Update endpoint" optional parameter 
"areas" is unique, because it can have 5 entries.
You can also specify which element to update or save.
Example "areas[lang][0]" - "areas[lang][4]", 0 - first item, 4 - fifth.
***
#### Show endpoint
``
GET {your-address}/api/job/lt/{posting id}/show
``

``
GET {your-address}/api/job/en/{posting id}/show
``
***
#### Index endpoint
``
GET {your-address}/api/job/lt/
``

``
GET {your-address}/api/job/en/
``

``
GET {your-address}/api/job/en/?page=2
``
***
#### Update endpoint
``
PUT {your-address}/api/job/{posting id}
``
###### Send your token as request header
```
Authorization -> bearer eyJ0eXAiOiJKV1QiLCJhbG
ciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N
0L2pvYnNBcGkvcHVibGljL2FwaS9hdXRoL2xvZ2luIiwia
WF0IjoxNjA2NDI5NDI2LCJleHAiOjE2MDY0MzMwMjYsIm5
iZiI6MTYwNjQyOTQyNiwianRpIjoiRHpRUHd0WWtJS0VWS
08yVCIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDB
hZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.nUFF7DaQ
T7P62DLheffDOh31OFzKKvBrTgMd1t2HZCc [mandatory]
```
###### Send data as 'x-www-form-urlencoded'
```
title[en] -> English title [mandatory]
title[lt] -> Lithuanian title [mandatory]
description[en] -> English description [mandatory]
description[lt] -> Lithuanian description [mandatory]
salary[en] -> English Salary [mandatory]
salary[lt] -> Lithuanim Salary [mandatory]
areas[lt][] -> Lithuanian Job area [optional * 5 entries] 
areas[en][] -> English Job area [optional * 5 entries] 
```
***
"Update endpoint" updates records created by the same user. 
***

