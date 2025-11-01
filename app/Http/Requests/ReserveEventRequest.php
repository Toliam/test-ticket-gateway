<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ReserveEventRequest",
 *     type="object",
 *     title="Reserve event request",
 *     description="Reserve event request",
 *     required={
 *         "name",
 *         "places",
 *     },
 *
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="User Name",
 *         example="John Doe"
 *     ),
 *     @OA\Property(
 *         property="places",
 *         type="array",
 *         description="List ids of the places for reservation",
 *         @OA\Items(type="integer", example=1)
 *     ),
 * ),
 *
 */
class ReserveEventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'places' => 'required|array|min:1',
            'places.*' => 'required|integer|min:1|distinct',
        ];
    }

    /**
     * When true authorization is not required.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
