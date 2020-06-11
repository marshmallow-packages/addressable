<?php

use Faker\Generator as Faker;
use Marshmallow\Addressable\Models\Address;

/**
 * factory(Marshmallow\Addressable\Models\Address::class, 10)->create();
 */
$factory->define(Address::class, function (Faker $faker) {
	return [
		//
    ];
});
