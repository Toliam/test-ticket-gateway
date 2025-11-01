<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Note: If we want to use DB in the future, I use models. If not, I will use DTOs.
 *
 * @property int $id
 * @property string $name
 */
class Show extends Model
{
    public $timestamps = false;

    protected $connection = 'array'; // remove when we use DB

    protected $fillable = [
        'id', // remove when store to db, it will be an auto increment.
        'name',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
