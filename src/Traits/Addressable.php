<?php

namespace Marshmallow\Addressable\Traits;

use Marshmallow\Addressable\Models\Address;

trait Addressable
{
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
