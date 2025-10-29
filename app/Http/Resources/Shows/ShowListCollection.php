<?php
declare(strict_types=1);

namespace App\Http\Resources\Shows;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShowListCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ShowListResource::class;
}
