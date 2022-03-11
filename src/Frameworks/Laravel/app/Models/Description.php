<?php

namespace Redzjovi\HotelbedsHotel\Frameworks\Laravel\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $language_code
 * @property string $content
 * @property string $descriptionable_id
 * @property string $descriptionable_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Description extends Model
{
    protected $connection = 'hotelbeds-hotel';

    protected $fillable = [
        'language_code',
        'content'
    ];

    public function descriptionable()
    {
        return $this->morphTo();
    }

    public function getTable()
    {
        return config('hotelbeds-hotel.table_names.descriptions');
    }
}