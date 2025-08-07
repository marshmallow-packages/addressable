<?php

namespace Marshmallow\Addressable\Nova;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\BelongsTo;
use Marshmallow\Addressable\Addresses;

class Address extends Resource
{
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Marshmallow\Addressable\Models\Address';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            MorphTo::make('Addressable', 'addressable')->onlyOnDetail(),
            BelongsTo::make(__('Address type'), 'addressType', Addresses::$addressTypeModel),
            Text::make(__('Name'))->help(
                __('This can be used as a reference for this address. For instance this could say: "Home" or "Office"')
            ),
            Text::make(__('Address'), 'address_line_1'),
            Text::make(__('Address Line 2'), 'address_line_2')->hideFromIndex(),
            Text::make(__('City'), 'city'),
            Text::make(__('State'), 'state')->hideFromIndex(),
            Text::make(__('Postal Code'), 'postal_code')->hideFromIndex(),
            BelongsTo::make(__('Country'), 'country', Addresses::$countryModel),
            Text::make(__('Latitude'), 'latitude')->hideFromIndex(),
            Text::make(__('Longitude'), 'longitude')->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
