<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Note: If we want to use DB in the future, I use models. If not, I will use DTOs.
 *
 * @property int $id
 * @property float $x
 * @property float $y
 * @property float $width
 * @property float $height
 * @property bool $is_available
 */
class Place extends Model
{
    public $timestamps = false;

    protected $connection = 'array'; // remove when we use DB

    protected $fillable = [
        'id', // remove when store to db, it will be an auto increment.
        'x',
        'y',
        'width',
        'height',
        'is_available',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
