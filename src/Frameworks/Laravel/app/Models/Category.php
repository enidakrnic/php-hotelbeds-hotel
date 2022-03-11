<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $accommodation_type
 * @property string $code
 * @property null|string $group
 * @property int $simple_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Description> $descriptions
 */
class Category extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'accommodation_type',
        'code',
        'group',
        'simple_code'
    ];

    public function descriptions()
    {
        return $this->morphMany(Description::class, 'descriptionable');
    }

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.categories');
    }
}
