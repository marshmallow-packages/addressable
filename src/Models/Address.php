<?php

namespace Marshmallow\Addressable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Marshmallow\Addressable\Models\AddressType;
use Marshmallow\Datasets\Country\Models\Country;

class Address extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        self::created(function ($address) {
            $has_default = self::sameOwner($address)
                                ->default()
                                ->first();
            if (!$has_default) {
                $address->makeDefault();
            }
        });

        self::deleted(function ($address) {
            $has_default = self::sameOwner($address)
                                ->notThisOne($address)
                                ->default()
                                ->first();
            if (! $has_default) {
                $first_result = self::sameOwner($address)->notThisOne($address)->first();
                if ($first_result) {
                    $first_result->makeDefault();
                }
            }
        });
    }

    public function makeDefault()
    {
        $defaults = self::sameOwner($this)
                        ->default()
                        ->get();

        foreach ($defaults as $default) {
            $default->update([
                'default' => false,
            ]);
        }

        $this->update([
            'default' => true,
        ]);
    }

    public function scopeNotThisOne(Builder $builder, Model $owner)
    {
        $builder->where('id', '!=', $owner->id);
    }

    public function scopeSameOwner(Builder $builder, Model $owner)
    {
        $builder->where('addressable_type', $owner->addressable_type)
                ->where('addressable_id', $owner->addressable_id)
                ->where('address_type_id', $owner->address_type_id);
    }

    public function scopeDefault(Builder $builder)
    {
        $builder->where('default', 1);
    }

    public function scopeWhereType(Builder $builder, AddressType $type)
    {
        $builder->where('address_type_id', $type->id);
    }

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
