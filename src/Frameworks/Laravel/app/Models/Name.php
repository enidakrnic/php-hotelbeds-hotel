<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $language_code
 * @property string $content
 * @property string $nameable_id
 * @property string $nameable_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Name extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'language_code',
        'content'
    ];

    public function nameable()
    {
        return $this->morphTo();
    }

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.names');
    }
}