<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Http\Requests\GoalRequest;
use Exception;

class GoalController extends Controller
{
    /**
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
}
