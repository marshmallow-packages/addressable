<?php

namespace Marshmallow\Addressable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Marshmallow\Datasets\Country\Models\Country;

class Address extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

    public function addressable()
    {
        return $this->morphTo();
    }
}
