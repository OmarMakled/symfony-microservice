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
