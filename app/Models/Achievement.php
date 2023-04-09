<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="Achievement",
 *   type="object",
 *   required={"id", "user_id", "goal_id", "status", "effort_time_minutes", "date"},
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     description="達成状況ID",
 *     example=1
 *   ),
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
 *     example=30
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
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="date-time",
 *     description="登録日時",
 *     example="2023-04-09T12:00:00Z"
 *   ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     format="date-time",
 *     description="更新日時",
 *     example="2023-04-09T12:00:00Z"
 *   )
 * )
 */
class Achievement extends Model
{
    protected $fillable = [
        'user_id', 'goal_id', 'status', 'effort_time_minutes', 'date', 'comment'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
