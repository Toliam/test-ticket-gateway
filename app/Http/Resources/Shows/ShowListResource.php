<?php
declare(strict_types=1);

namespace App\Http\Resources\Shows;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ShowListResource",
 *     type="object",
 *     title="Show list",
 *     description="List of shows",
 *     required={
 *         "id",
 *         "name",
 *     },
 *
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="Id of show",
 *          example=1
 *      ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Title of the show",
 *         example="Show #1"
 *     )
 * )
 */
class ShowListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
