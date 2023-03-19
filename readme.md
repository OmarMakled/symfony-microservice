## Symfony6 Microservice Demo

![Screenshot from 2023-03-19 20-16-15](https://user-images.githubusercontent.com/3720473/226198412-709368bf-a3b0-47bd-aefd-0d6a3a928579.png)

## Installation

- To start the project you need to run `docker compose up -d` it will pull the images if not exists and spin up the containers.

- Run `make install` to install dependencies if this is the first time. :dart:

## Import data

- Run `make import` this command will fetch data from a specific API and insert it into DB.
- Send a confirmation email **async** for each inserted row. see rabbitmq

## Open client

![Screenshot from 2023-03-19 20-18-11](https://user-images.githubusercontent.com/3720473/226198443-55edb85e-66ee-4ebf-8d0f-657be5930e37.png)

Run `make client` this will run `vuejs` project with hot reload

## Run Tests

Run `make test` to execute all tests


## RabbitMQ

![Screenshot from 2023-03-19 20-31-22](https://user-images.githubusercontent.com/3720473/226199072-02ea3fbf-6a86-475c-ba2c-394743b2672a.png)

Sending email **async**  you can check queue messages where each message contains serialized data which will use on the consumer side for sending emails

Rabbitmq `http://localhost:15672/` 
- username: user
- password: password

## API

base url `http://localhost:8080`

| type   | url                         |  description            |
| ------ | --------------------------- | ---------------------- |
| GET   | /api/fruits             |  Get list of fruites     |
| GET   | /api/fruits/name           | Get list of names    |
| GET   | /api/fruits/family           | Get list of familes    |

#### Get list of fruits

`GET /api/fruits`
```
"total": 324,
"items": [
{
   "id": 1,
   "name": "Apple",
   "family": "Rosaceae",
   "order": "Rosales",
   "genus": "Malus",
   "nutritions": {
      "fat": 0.4,
      "sugar": 10.3,
      "protein": 0.3,
      "calories": 52,
      "carbohydrates": 11.4
  }
}, ...]
```

#### Get list of names

`GET /api/fruits/name`
```
"items": [
   "Apple",
   "Apricot",
   "Avocado",
   "Banana",
   "Blackberry",
]
```

#### Get list of families

`GET /api/fruits/family`
```
"items": [
   "Rosaceae",
   "Lauraceae",
   "Musaceae",
   "Ericaceae",
   "Cactaceae",
   "Malvaceae",
]
```

## Code standard

You can check the code against the PSR-12 coding standard and eslint  by running `make autofix`

## Stop/Start containers

Run `make stop` or `make up` to start containers again