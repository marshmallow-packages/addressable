![alt text](https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png "marshmallow.")

# Marshmallow Addressable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marshmallow/addressable.svg?style=flat-square)](https://packagist.org/packages/marshmallow/addressable)
[![Tests](https://img.shields.io/github/actions/workflow/status/marshmallow-packages/addressable/php-syntax-checker.yml?branch=main&label=tests&style=flat-square)](https://github.com/marshmallow-packages/addressable/actions/workflows/php-syntax-checker.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/marshmallow/addressable.svg?style=flat-square)](https://packagist.org/packages/marshmallow/addressable)

Add polymorphic addresses to any Eloquent model. The package ships `Address` and `AddressType` models, a `morphMany` relationship via an `Addressable` trait, automatic default-address management, country support through `marshmallow/dataset-country`, and optional Laravel Nova resources.

## Installation

Install the package via Composer:

```bash
composer require marshmallow/addressable
```

The service provider is auto-discovered and the package loads its own migrations, so you only need to run:

```bash
php artisan migrate
```

This creates the `addresses` and `address_types` tables.

Optionally publish the config file:

```bash
php artisan vendor:publish --provider="Marshmallow\Addressable\ServiceProvider"
```

### Address types

Run the seeder if you want some default address types in the `address_types` table. This creates a `Shipping address` and an `Invoice address`. The names are added to your database in your application locale (English and Dutch are supported for seeding).

```bash
php artisan db:seed --class=Marshmallow\\Addressable\\Seeders\\AddressTypeSeeder
```

## Configuration

| Key | Default | Description |
| --- | --- | --- |
| `default_address_type` | `5` | ID of the `AddressType` assigned to a new address when none is provided. |

## Usage

Add the `Addressable` trait to any model you want to give addresses to:

```php
use Illuminate\Database\Eloquent\Model;
use Marshmallow\Addressable\Traits\Addressable;

class User extends Model
{
    use Addressable;
}
```

### Adding addresses

The trait exposes a polymorphic `addresses()` relationship:

```php
$user->addresses()->create([
    'address_line_1' => 'Keizersgracht 123',
    'postal_code'    => '1015 CJ',
    'city'           => 'Amsterdam',
    'state'          => 'Noord-Holland',
    'country_id'     => $country->id,
]);
```

When an address is created without an `address_type_id`, the `default_address_type` from the config is used. The first address created for a given owner and type is automatically flagged as the default. When a default address is deleted, the next available address of the same owner is promoted to default.

### Default addresses

Retrieve the default address for a given type. The `$type` matches the `type` column on `AddressType` — use the `AddressType::SHIPPING` or `AddressType::INVOICE` constants:

```php
use Marshmallow\Addressable\Models\AddressType;

$shippingAddress = $user->getDefaultAddress(AddressType::SHIPPING);
```

Mark a specific address as the default for its owner and type:

```php
$address->makeDefault();
```

### Formatting

Render an address as a single comma-separated string (empty parts are skipped):

```php
$address->getAsString();
// "Keizersgracht 123, 1015 CJ, Amsterdam, Noord-Holland"
```

### Model relationships and scopes

The `Address` model exposes the following relationships:

- `addressable()` — the owning model (morph-to).
- `addressType()` — the related `AddressType`.
- `country()` — the related country from `marshmallow/dataset-country`.

And the following query scopes: `default()`, `whereType($addressType)`, `sameOwner($owner)`, `notThisOne($owner)`.

The models, country model, address-type model, and country connection used internally can be swapped via the static properties on `Marshmallow\Addressable\Addresses`.

## Nova

Are you using Nova? There is a command to generate the Nova resources. Run the commands below and the resources will be available in Nova. The `Address` resource is hidden from the Nova navigation by default. If you want it in the navigation, add `public static $displayInNavigation = true;` to `app/Nova/Address.php`.

```bash
php artisan marshmallow:resource Address Addressable
php artisan marshmallow:resource AddressType Addressable
```

To make addresses visible on one of your own Nova resources, add `MorphMany::make('Addresses'),` to its `fields()` method.

## Testing

Run the package tests during development:

```bash
php artisan test packages/marshmallow/addressable
```

## Security Vulnerabilities

Please report security vulnerabilities by email to [stef@marshmallow.dev](mailto:stef@marshmallow.dev) rather than via the public issue tracker.

## Credits

- [Stef](https://marshmallow.dev)
- [All Contributors](https://github.com/marshmallow-packages/addressable/contributors)

## License

The MIT License (MIT). Please see the [License File](LICENSE) for more information.

- - -

Copyright (c) 2020 marshmallow
