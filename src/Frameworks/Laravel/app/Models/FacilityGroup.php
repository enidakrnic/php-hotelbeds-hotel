<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Description> $descriptions
 */
class FacilityGroup extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'code'
    ];

    public function descriptions()
    {
        return $this->morphMany(Description::class, 'descriptionable');
    }

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.facility_groups');
    }
}
