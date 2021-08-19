<?php

namespace Marshmallow\Addressable\Traits;

use Marshmallow\Addressable\Addresses;

trait Addressable
{
    public function addresses()
    {
        return $this->morphMany(Addresses::$addressModel, 'addressable');
    }

    public function getDefaultAddress(string $type)
    {
        $type = Addresses::$addressTypeModel::where('type', $type)->firstOrFail();
        return $this->addresses()->whereType($type)->default()->first();
    }
}
