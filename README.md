
# Market


## Start Project
### Create ".env" file for get environments install project
```bash 
cp .env.example .env 
```
### For running project we need install laravel sail.
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

### Then start sail

```bash
./vendor/bin/sail up -d
```

### Next you need generate app key

```bash
./vendor/bin/sail artisan key:generate
```

### For running database migration

```bash
./vendor/bin/sail artisan migrate
```

### Config Passport

```bash
./vendor/bin/sail artisan passport:install
```
```bash
./vendor/bin/sail artisan passport:client --personal
```

and put client id and client secret to .env
```
PASSPORT_PERSONAL_ACCESS_CLIENT_ID="client-id-value"
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET="unhashed-client-secret-value"
```

### Now you can see project running on port 8001:
[http://localhost:8001](htts://localhost:8001)

## Swagger

### For generating swagger docs

```bash
./vendor/bin/sail artisan swagger:generate
```

### Then you can visit
[http://localhost:8002](http://localhost:8002)
