<?php

namespace Marshmallow\Addressable\Seeders;

use Illuminate\Database\Seeder;
use Marshmallow\Addressable\Models\AddressType;

/**
 * php artisan db:seed --class=Marshmallow\\Addressable\\Seeders\\AddressTypeSeeder
 */

class AddressTypeSeeder extends Seeder
{
    protected $default_address_types = [
        [
            'name' => 'Shipping address',
            'type' => AddressType::SHIPPING,
        ],
        [
            'name' => 'Invoice address',
            'type' => AddressType::INVOICE,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->default_address_types as $type) {

            if (AddressType::where('name', $type['name'])->first()) {
                continue;
            }

            AddressType::create([
                'name' => $type['name'],
                'type' => $type['type'],
            ]);
        }
    }
}
