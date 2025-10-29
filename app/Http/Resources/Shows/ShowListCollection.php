<?php
declare(strict_types=1);

namespace App\Http\Resources\Shows;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @OA\Schema(
 *      schema="ShowListCollection",
 *      description="List of shows",
 *      title="Show list",
 *      type="object",
 *
 *      @OA\Property(
 *          property="data",
 *          type="array",
 *          description="List of shows",
 *          title="Show list",
 *
 *          @OA\Items(ref="#/components/schemas/ShowListResource")
 *      )
 * )
 */
class ShowListCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ShowListResource::class;
}
