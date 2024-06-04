# Laravel IProxy Package

The Laravel IProxy package provides a convenient way to interact with the iProxy API for managing proxy configurations in Laravel applications.

## Installation

You can install the package via Composer:

```bash
composer require sazharul/iproxy
```

Publish the package configuration file using Artisan:

```bash
php artisan vendor:publish --provider="Sazharul\Iproxy\IproxyServiceProvider"
```

## Usage

```php
use Sazharul\Iproxy\Facades\Iproxy;

// Get the list of connections
$connections = Iproxy::getConnectionList();

// Get proxies for a specific connection
$proxies = Iproxy::getProxiesByConnectionId($connectionId);

// Create a new proxy
$newProxy = Iproxy::createProxy($connectionId);

// Delete a proxy
$deleteResponse = Iproxy::deleteProxy($connectionId, $proxyId);

// Update a proxy
$updateResponse = Iproxy::updateProxy($connectionId, $proxyId, $data);

// Change the password of a proxy
$passwordChangeResponse = Iproxy::changeProxyPassword($connectionId, $proxyId, $newPassword);

// Change the login of a proxy
$loginChangeResponse = Iproxy::changeProxyLogin($connectionId, $proxyId, $newLogin);
```

Make sure to replace `Sazharul` with your package vendor name and `Iproxy` with your package name.

## Configuration

You need to set your iProxy API key in the `config/iproxy.php` file.

```php
return [
    'api_key' => env('IPROXY_KEY'),
];
```

## License

The Laravel IProxy package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
```

Feel free to modify this documentation as needed, adding more details, examples, or instructions specific to your package.