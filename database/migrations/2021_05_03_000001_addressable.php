<?php

use Illuminate\Database\Migrations\Migration;
use Marshmallow\Addressable\Models\AddressType;

return new class extends Migration
{
    public function up()
    {
        $default = AddressType::where('type', 'DEFAULT')->first();
        if (!$default) {
            AddressType::create([
                'name' => 'Default',
                'slug' => 'default',
                'type' => 'DEFAULT',
            ]);
        }
    }
};
