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
        'Shipping address', 'Postal address'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->default_address_types as $type) {
            $translated = trans('addressable::address_types.' . $type);
            if (AddressType::where('name', $translated)->first()) {
                continue;
            }

            AddressType::create([
                'name' => $translated,
            ]);
        }
    }
}
