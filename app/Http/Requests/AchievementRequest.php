<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="AchievementRequest",
 *   type="object",
 *   required={"user_id", "goal_id", "status", "date"},
 *   @OA\Property(
 *     property="user_id",
 *     type="integer",
 *     format="int64",
 *     description="ユーザーID",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="goal_id",
 *     type="integer",
 *     format="int64",
 *     description="目標ID",
 *     example=1
 *   ),
 *   @OA\Property(
 *     property="status",
 *     type="string",
 *     description="達成状況のステータス",
 *     example="未達成"
 *   ),
 *   @OA\Property(
 *     property="effort_time_minutes",
 *     type="integer",
 *     format="int64",
 *     description="努力時間（分）",
 *     example=30,
 *     nullable=true
 *   ),
 *   @OA\Property(
 *     property="date",
 *     type="string",
 *     format="date",
 *     description="達成状況の日付",
 *     example="2023-04-09"
 *   ),
 *   @OA\Property(
 *     property="comment",
 *     type="string",
 *     description="コメント",
 *     example="今日は頑張った",
 *     nullable=true
 *   )
 * )
 */
class AchievementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'goal_id' => 'required|integer',
            'status' => 'required|string',
            'effort_time_minutes' => 'nullable|integer',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ];
    }
}
