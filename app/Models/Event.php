<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Note: If we want to use DB in the future, I use models. If not, I will use DTOs.
 *
 * @property int $id
 * @property string $date - Note: no need working with date and convert it to Carbon
 */
class Event extends Model
{
    public $timestamps = false;

    protected $connection = 'array'; // remove when we use DB

    protected $fillable = [
        'id', // remove when store to db, it will be an auto increment.
        'date',
    ];

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
