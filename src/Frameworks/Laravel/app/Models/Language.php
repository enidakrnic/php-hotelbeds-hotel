<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $code
 * @property null|string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Description> $descriptions
 */
class Language extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'code',
        'name'
    ];

    public function descriptions()
    {
        return $this->morphMany(Description::class, 'descriptionable');
    }

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.languages');
    }
}