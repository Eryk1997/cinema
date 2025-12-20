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

10. Test update GET room -> /api/rooms?currentPage=1&pageSize=50
```
{
    "response": true,
    "data": [
        {
            "name": "test",
            "seats": [
                {
                    "row": 2,
                    "column": 1
                },
                {
                    "row": 1,
                    "column": 5
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
