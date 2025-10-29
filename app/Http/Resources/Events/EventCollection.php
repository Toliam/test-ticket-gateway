<?php
declare(strict_types=1);

namespace App\Http\Resources\Events;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = EventResource::class;
}
