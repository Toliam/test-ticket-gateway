<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class Show extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function events(): hasMany
    {
        return $this->hasMany(Event::class);
    }
}
