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
