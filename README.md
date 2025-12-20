1. Stwórz sieć Docker:
   ```bash
   docker network create cinema-project
2. override docker-compose.override.yaml
3. Uruchom kontenery:
   ```bash
   docker compose up -d
4. Wykonaj migracje bazy danych:
   ```bash
    docker compose exec -it cinema-php ./bin/console doctrine:migrations:migrate
5. Generowanie JWT
   ```bash
    docker compose exec -it cinema-php ./bin/console lexik:jwt:generate-keypair
6. Test login -> /api/auth/login

```
{
  "email": "eryk.janocha@gmail.com",
  "password": "test123"
}
``` 

Example Response:

```
{
    "response": true,
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3NjYyMjUxNjIsImV4cCI6MTc2NjIyODc2Miwicm9sZXMiOlsiUk9MRV9BRE1JTiJdLCJ1c2VybmFtZSI6ImVyeWsuamFub2NoYUBnbWFpbC5jb20ifQ.Qyb0ZmfJKfawnI1rA9c0FuJ7aXdBCeGbOwjV55KQlrBPaHrDpIWLeuJioaMx2v-4vT0yqguQLdx-k-YhbADwzQyORv-VJ2AzQdpHV-nIsbXQVvyHp5h5a6aMN_4bYixBDRTFL1MXcEsp4ZCDTWQOj_TEVsAxV8f3ESC8RpDH9Y_-nCFbNIvoUp2x40Rm2iLKIQvbOVGO6NFmBU8SVaHHfavX5ETazBDeQl46JkVsCYUNgdgJXDqmTEGFikcod4UcAZlsRR0z_sP-1yaJNxD_4mImy-xdobOBh7yMSKQShfJI6UpTSYnw2HtknaicyhCSnvULZHk-yxy5HviMY4H30g",
        "email": "eryk.janocha@gmail.com"
    }
}
```

7. Test create room -> /api/rooms
```
{
    "name": "test",
    "seats": [
        {
            "row": 1,
            "column": 1
        },
        {
            "row": 1,
            "column": 2
        },
        {
            "row": 1,
            "column": 3
        }
    ]
}
```

8. Test remove DELETE room -> /api/rooms/{id}

9. Test update PATCH room -> /api/rooms/{id}
```
{
    "name": "test",
    "seats": [
        {
            "id": "019b3bd9-39a7-7201-9cfd-e36c393f3f46",
            "row": 1,
            "column": 1
        },
        {
            "row": 1,
            "column": 2
        },
        {
            "row": 1,
            "column": 3
        }
    ]
}
```

10. Test update GET screenings -> /api/screenings?currentPage=1&pageSize=50
```
{
    "response": true,
    "data": [
        {
            "movieTitle": "Gladiator 2",
            "roomName": "Sala Premierowa",
            "startTime": "2025-12-25 20:00:00",
            "seats": [
                {
                    "row": 1,
                    "column": 1,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 2,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 3,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 4,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 5,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 6,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 7,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 8,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 9,
                    "isAvailable": true
                },
                {
                    "row": 1,
                    "column": 10,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 1,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 2,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 3,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 4,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 5,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 6,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 7,
                    "isAvailable": false
                },
                {
                    "row": 2,
                    "column": 8,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 9,
                    "isAvailable": true
                },
                {
                    "row": 2,
                    "column": 10,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 1,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 2,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 3,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 4,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 5,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 6,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 7,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 8,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 9,
                    "isAvailable": true
                },
                {
                    "row": 3,
                    "column": 10,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 1,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 2,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 3,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 4,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 5,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 6,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 7,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 8,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 9,
                    "isAvailable": true
                },
                {
                    "row": 4,
                    "column": 10,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 1,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 2,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 3,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 4,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 5,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 6,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 7,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 8,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 9,
                    "isAvailable": true
                },
                {
                    "row": 5,
                    "column": 10,
                    "isAvailable": true
                }
            ]
        }
    ],
    "pagination": {
        "previousPage": null,
        "nextPage": null,
        "pageSize": 50,
        "totalCount": 1,
        "currentPage": 1
    }
}
```

11. Generowanie fixtur
```
docker compose exec -it cinema-php php bin/console doctrine:fixtures:load --no-interaction
```

12. Test update POST reservations -> /api/reservations
```
{
    "screeningId": "019b3c4c-d61c-7c21-8260-2eae977f237c",
    "customerEmail": "test@o2.pl",
    "seats": [
        {
            "id": "019b3c4c-d61c-7c21-8260-2eae85756021"
        }
    ]
}
```

13. docker compose exec cinema-db mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS cinema_db_test_test;"
14. docker compose exec cinema-db mysql -u root -p -e "GRANT ALL PRIVILEGES ON \`cinema_db_test_test\`.* TO 'cinema'@'%'; FLUSH PRIVILEGES;"
15. docker compose exec -it cinema-php php bin/console doctrine:schema:update --force --env=test
16. docker compose exec -it cinema-php vendor/bin/phpunit tests/Modules/Room/Api/Controller/DeleteRoomApiTest.php
```
PHPUnit 12.5.4 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.4.15
Configuration: /var/www/html/phpunit.dist.xml

..                                                                  2 / 2 (100%)

Time: 00:00.052, Memory: 32.50 MB

OK (2 tests, 4 assertions)
```
17. docker compose exec -it cinema-php vendor/bin/phpunit tests/Modules/Room/Domain/Entity/RoomTest.php
```
PHPUnit 12.5.4 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.4.15
Configuration: /var/www/html/phpunit.dist.xml

..                                                                  2 / 2 (100%)

Time: 00:00.001, Memory: 14.00 MB

OK (2 tests, 2 assertions)
```
