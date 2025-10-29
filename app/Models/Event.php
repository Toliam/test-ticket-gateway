<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $date - Note: no need working with date and convert it to Carbon
 */
class Event extends Model
{
    protected $fillable = [
        'id',
        'date',
    ];

    public function show(): belongsTo
    {
        return $this->belongsTo(Show::class);
    }

    public function places(): hasMany
    {
        return $this->hasMany(Place::class);
    }
}
