# PHP Hotelbeds Hotel

## Installation

### Composer

```bash
composer require redzjovi/php-hotelbeds-hotel:dev-master
```

### Laravel

You can publish `the migration` and the `config/hotelbeds-php.php` with:

```bash
php artisan hotelbeds-hotel:install
```

### How to test with PHPUnit

```bash
phpunit --filter /test_get_languages$/
phpunit --group types
```

Add new connection database `hotelbeds-hotel` in `config/database.php`.

## API

### Hotel Content API

#### Types

##### Languages

```php
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Requests\Types\Languages\IndexRequest as TypesLanguagesIndexRequest;

$client = new Client(
    getenv('HOTELBEDS_HOTEL_API_KEY'),
    getenv('HOTELBEDS_HOTEL_SECRET'),
    getenv('HOTELBEDS_HOTEL_ENVIRONMENT')
);

$request = new TypesLanguagesIndexRequest();
$response = $$client->getLanguages($request);
```
