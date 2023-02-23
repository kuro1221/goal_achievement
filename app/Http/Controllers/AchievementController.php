<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use Exception;

class AchievementController extends Controller
{
    /**
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
