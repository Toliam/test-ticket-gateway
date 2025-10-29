<?php
declare(strict_types=1);

namespace App\Http\Resources\Places;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     schema="ReservePlacesResource",
 *     type="object",
 *     title="Reserve places resource",
 *     description="Reserve places resource",
 *
 *     @OA\Property(
 *         property="success",
 *         type="boolean",
 *         description="Is store was successful",
 *         example=true
 *     ),
 *     @OA\Property(
 *          property="reservation_id",
 *          type="string",
 *          description="External reservation id",
 *          example="6901e4e119c02"
 *      ),
 * )
 */
class ReservePlacesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'success' => $this->success,
            'reservation_id' => $this->reservationId,
        ];
    }
}
