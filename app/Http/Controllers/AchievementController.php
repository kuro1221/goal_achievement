<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use Exception;
use OpenApi\Annotations as OA;

class AchievementController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/achievement",
     *   operationId="recordAchievement",
     *   tags={"目標達成状況"},
     *   summary="1日の目標達成状況を記録",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/AchievementRequest")
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="達成状況登録成功時のレスポンス",
     *     @OA\JsonContent(ref="#/components/schemas/Achievement")
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="達成状況登録失敗時のレスポンス",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="エラー発生しました"
     *       )
     *     )
     *   )
     * )
     * *
     * 1日の目標達成状況を記録
     *
     * @param Request $request
     * @return void
     */
    public function recordAchievement(Request $request)
    {
        try {
            $achievement = new Achievement;
            $achievement->fill($request->all());
            $achievement->save();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'エラー発生しました',
            ], 500);
        }

        return response()->json([
            'message' => '達成状況を登録しました',
            'data' => $achievement
        ], 200);
    }


    /**
     * @OA\Get(
     *   path="/api/achievementList",
     *   operationId="getAchievementList",
     *   tags={"目標達成状況"},
     *   summary="全員の目標達成状況を取得",
     *   @OA\Response(
     *     response="200",
     *     description="目標達成状況一覧取得成功時のレスポンス",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="目標達成状況一覧を取得しました"
     *       ),
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Achievement")
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="目標達成状況一覧取得失敗時のレスポンス",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="エラー発生しました"
     *       )
     *     )
     *   )
     * )
     *
     * 全員の目標達成状況を取得
     *
     * @return void
     */
    public function getAchievementList()
    {
        try {
            // TODO 削除された目標は取得しないよう修正
            $achievement_list = Achievement::all();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'エラー発生しました',
            ], 500);
        }

        return response()->json([
            'message' => '目標一覧を取得しました',
            'data' => $achievement_list
        ], 200);
    }
}
