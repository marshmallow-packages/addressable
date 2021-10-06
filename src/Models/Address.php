<?php

namespace Marshmallow\Addressable\Models;

use Marshmallow\Addressable\Addresses;
use Illuminate\Database\Eloquent\Model;
use Marshmallow\Addressable\Addressable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        self::creating(function ($address) {
            if (!$address->address_type_id) {
                $address->address_type_id = config('addressable.default_address_type');
            }
        });

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
            if (!$has_default) {
                $first_result = self::sameOwner($address)->notThisOne($address)->first();
                if ($first_result) {
                    $first_result->makeDefault();
                }
            }
        });
    }

    public function getAsString()
    {
        $parts = [
            $this->address_line_1,
            $this->address_line_2,
            $this->postal_code,
            $this->city,
            $this->state,
        ];

        $parts = array_filter($parts);

        return join(', ', $parts);
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
        return $this->setConnection(Addresses::$countryConnection)
            ->belongsTo(Addresses::$countryModel);
    }

    public function addressType()
    {
        return $this->belongsTo(Addresses::$addressTypeModel);
    }

    public function addressable()
    {
        return $this->morphTo();
    }
}
