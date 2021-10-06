<?php

namespace Marshmallow\Addressable\Seeders;

use Illuminate\Database\Seeder;
use Marshmallow\Addressable\Addresses;

/**
 * php artisan db:seed --class=Marshmallow\\Addressable\\Seeders\\AddressTypeSeeder
 */

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_address_types = [
            [
                'name' => 'Shipping address',
                'type' => Addresses::$addressTypeModel::SHIPPING,
            ],
            [
                'name' => 'Invoice address',
                'type' => Addresses::$addressTypeModel::INVOICE,
            ],
        ];

        foreach ($default_address_types as $type) {

            if (Addresses::$addressTypeModel::where('name', $type['name'])->first()) {
                continue;
            }

            Addresses::$addressTypeModel::create([
                'name' => $type['name'],
                'type' => $type['type'],
            ]);
        }
    }
}
