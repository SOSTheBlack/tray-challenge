# Hub


```shell
cp .env.example .env
```

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

```shell
sail artisan migrate
```

```shell
sail artisan module:seed Hub
```

cURL

```shell
curl --location 'http://127.0.0.1/api/webhooks' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data '{
    "product_ref": "20231001",
    "scope": "price"
}'
```

```shell
sail artisan queue:work --queue=webhooks
```


