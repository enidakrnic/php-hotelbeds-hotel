<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $code
 * @property string $type_description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Description> $typeMultiDescriptions
 */
class Accommodation extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'code',
        'type_description'
    ];

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.accommodations');
    }

    public function typeMultiDescriptions()
    {
        return $this->morphMany(Description::class, 'descriptionable');
    }
}