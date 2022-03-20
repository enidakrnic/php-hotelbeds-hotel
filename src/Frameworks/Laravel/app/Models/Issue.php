<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $code
 * @property string $type
 * @property int $alternative
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<Description> $descriptions
 * @property-read Collection<Name> $names
 */
class Issue extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'code',
        'type',
        'alternative'
    ];

    public function descriptions()
    {
        return $this->morphMany(Description::class, 'descriptionable');
    }

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.issues');
    }

    public function names()
    {
        return $this->morphMany(Name::class, 'nameable');
    }
}
