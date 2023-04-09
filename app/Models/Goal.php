<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *   schema="Goal",
 *   type="object",
 *   required={"title", "user_id"},
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     format="int64",
 *     description="目標ID",
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
 *     property="title",
 *     type="string",
 *     description="目標タイトル",
 *     example="ランニング"
 *   ),
 *   @OA\Property(
 *     property="description",
 *     type="string",
 *     nullable=true,
 *     description="目標詳細",
 *     example="サブ4を目指す"
 *   ),
 *   @OA\Property(
 *     property="start_date",
 *     type="string",
 *     format="date",
 *     nullable=true,
 *     description="目標開始日",
 *     example="2023-04-01"
 *   ),
 *   @OA\Property(
 *     property="due_date",
 *     type="string",
 *     format="date",
 *     nullable=true,
 *     description="目標期限日",
 *     example="2023-08-31"
 *   ),
 *   @OA\Property(
 *     property="comment",
 *     type="string",
 *     nullable=true,
 *     description="目標のコメント",
 *     example="頑張る"
 *   ),
 *   @OA\Property(
 *      property="achieved_at",
 *      type="string",
 *      format="date",
 *      description="目標達成日",
 *      example="2023-08-15",
 *      nullable=true
 *   ),
 *   @OA\Property(
 *      property="status",
 *      type="string",
 *      description="目標ステータス",
 *      example="active"
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="date-time",
 *     description="作成日時",
 *     example="2023-04-01T10:00:00+09:00"
 *   ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     format="date-time",
 *     description="更新日時",
 *     example="2023-04-01T10:00:00+09:00"
 *   )
 * )
 */

class Goal extends Model
{
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'title', 'description', 'start_date', 'due_date', 'achieved_at', 'status', 'comment'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
