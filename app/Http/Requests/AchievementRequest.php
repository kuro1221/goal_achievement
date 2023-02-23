<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
