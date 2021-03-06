<?php

namespace Marshmallow\Addressable\Traits;

use Marshmallow\Addressable\Models\Address;
use Marshmallow\Addressable\Models\AddressType;

trait Addressable
{
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function getDefaultAddress(string $type)
    {
        $type = AddressType::where('type', $type)->firstOrFail();
        return $this->addresses()->whereType($type)->default()->first();
    }
}
