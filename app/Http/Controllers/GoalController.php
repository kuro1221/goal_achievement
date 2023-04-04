<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Http\Requests\GoalRequest;
use Exception;
use OpenApi\Annotations as OA;

class GoalController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/goal",
     *   operationId="createGoal",
     *   tags={"目標"},
     *   summary="ユーザーの目標を登録します",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/GoalRequest")
     *   ),
     *   @OA\Response(
     *     response="200",
     *     description="目標登録成功時のレスポンス",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="目標を登録しました"
     *       ),
     *     )
     *   ),
     *   @OA\Response(
     *     response="500",
     *     description="目標登録失敗時のレスポンス",
     *     @OA\JsonContent(
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="エラー発生しました"
     *       ),
     *     )
     *   )   
     * )
     *
     * 目標を登録
     *
     * @param GoalRequest $request
     * @return void
     */
    public function createGoal(GoalRequest $request)
    {
        try {
            $goal = new Goal;
            $goal->fill($request->all());
            // TODO ログイン中のユーザーIDを格納するよう修正
            $goal->user_id = $request->user_id;
            $goal->status = GOAL::STATUS_ACTIVE;
            $goal->save();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'エラー発生しました',
            ], 500);
        }

        return response()->json([
            'message' => '目標を登録しました',
            'data' => $goal
        ], 200);
    }

    /**
     * 全員の目標を取得
     *
     * @return void
     */
    public function getGoalList()
    {
        try {
            $goal_list = Goal::where('status', '=', Goal::STATUS_ACTIVE)
                ->orderBy('user_id', "asc")
                ->get();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'エラー発生しました',
            ], 500);
        }

        return response()->json([
            'message' => '目標一覧を取得しました',
            'data' => $goal_list
        ], 200);
    }

    public function test()
    {
        return response()->json([
            'message' => 'テスト成功',
        ], 200);
    }
}
