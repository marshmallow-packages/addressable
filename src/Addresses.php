<?php

namespace Marshmallow\Addressable;

use Marshmallow\Addressable\Models\Address;
use Marshmallow\Addressable\Models\AddressType;
use Marshmallow\Datasets\Country\Models\Country;

class Addresses
{
    public static $addressModel = Address::class;
    public static $countryModel = Country::class;
    public static $addressTypeModel = AddressType::class;
}
