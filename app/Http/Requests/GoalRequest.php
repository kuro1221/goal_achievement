<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

// TODO user_idはログイン中のユーザーIDを格納するよう修正すること
/**
 *  @OA\Schema(
 *    title="GoalRequest",
 *    @OA\Property(
 *      property="title",
 *      type="string",
 *      maxLength=255,
 *      description="目標のタイトル",
 *      example="ランニング",
 *    ),
 *    @OA\Property(
 *      property="description",    
 *      type="string",
 *      description="目標の詳細",
 *      example="サブ4を目指す",
 *      nullable=true
 *    ),
 *    @OA\Property(
 *      property="start_date",
 *      type="string",
 *      format="date",
 *      description="目標の開始日",
 *      example="2021-01-01",
 *      nullable=true
 *    ),
 *    @OA\Property(
 *      property="due_date",
 *      type="string",
 *      format="date",
 *      description="目標の期限日",
 *      example="2021-12-31",
 *      nullable=true
 *    ),
 *    @OA\Property(
 *      property="comment",
 *      type="string",
 *      description="目標のコメント",
 *      example="頑張る",
 *      nullable=true
 *    ),
 *    @OA\Property(
 *      property="user_id",
 *      type="integer",
 *      description="ユーザーID",
 *      example="1", 
 *   )
 * )
 */
class GoalRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'comment' => 'nullable|string',
        ];
    }
}
