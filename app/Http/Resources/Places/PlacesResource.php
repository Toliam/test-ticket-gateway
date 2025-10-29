<?php
declare(strict_types=1);

namespace App\Http\Resources\Places;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="PlacesResource",
 *     type="object",
 *     title="Places resource",
 *     description="Places resource",
 *     required={
 *         "id",
 *         "x",
 *         "y",
 *         "width",
 *         "height",
 *         "is_available"
 *     },
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="x",
 *         type="number",
 *         format="float",
 *         description="Coordinate X",
 *         example="45.33"
 *     ),
 *     @OA\Property(
 *         property="y",
 *         type="number",
 *         format="float",
 *         description="Coordinate Y",
 *         example="145.88"
 *     ),
 *     @OA\Property(
 *         property="width",
 *         type="number",
 *         format="float",
 *         description="Width",
 *         example="15.77"
 *     ),
 *     @OA\Property(
 *         property="height",
 *         type="number",
 *         format="float",
 *         description="Width",
 *         example="77.15"
 *     ),
 *     @OA\Property(
 *         property="is_available",
 *         type="boolean",
 *         description="Is this place available",
 *         example=true
 *     )
 * )
 */
class PlacesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'height' => $this->height,
            'is_available' => $this->is_available,
        ];
    }
}
