<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $code
 * @property int $facility_group_code
 * @property int $facility_typology_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Description> $descriptions
 */
class Facility extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'code',
        'facility_group_code',
        'facility_typology_code'
    ];

    public function descriptions()
    {
        return $this->morphMany(Description::class, 'descriptionable');
    }

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.facilities');
    }
}
