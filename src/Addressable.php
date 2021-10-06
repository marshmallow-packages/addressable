<?php

namespace Marshmallow\Addressable;

use Marshmallow\Addressable\Models\AddressType;
use Marshmallow\Datasets\Country\Models\Country;

class Addressable
{
    public static $countryModel = Country::class;
    public static $addressTypeModel = AddressType::class;
}
