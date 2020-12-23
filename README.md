![alt text](https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png "marshmallow.")

# Marshmallow Addressable
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

### Installatie
```
composer require marshmallow/example
```

```
php artisan migrate
```

# Nova
Are you using Nova? We have a command for you to generate the Nova Resource. Run the commands below and the resources will be available to you in Nova. We hide the Address resource by default in the Nova navigation. If you wish to have it available in the navigation, add `public static $displayInNavigation = true;` to `app/Nova/Address.php`.

`php artisan marshmallow:resource Address Addressable`
`php artisan marshmallow:resource AddressType Addressable`

Run the seeder if you wish to have some defaults in the address type table. This will create a type of `Shipping address` and a type of `Postal address`. These types will be added to your database in your setup locale. Currently we only support English and Dutch for seeding these records.
```
php artisan db:seed --class=Marshmallow\\Addressable\\Seeders\\AddressTypeSeeder
```

To make the address visable on your Nova resource, you need to add `MorphMany::make('Addresses'),` to your `fields()` method.

## Tests during development
`php artisan test packages/marshmallow/addressable`
...


- - -

Copyright (c) 2020 marshmallow
