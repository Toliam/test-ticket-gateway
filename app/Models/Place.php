<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property float $x
 * @property float $y
 * @property float $width
 * @property float $height
 * @property bool $is_available
 */
class Place extends Model
{
    protected $fillable = [
        'id',
        'x',
        'y',
        'width',
        'height',
        'is_available',
    ];

    public function event(): belongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
