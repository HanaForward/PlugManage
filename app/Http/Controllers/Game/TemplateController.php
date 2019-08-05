<?php

namespace App\Http\Controllers\Game;

use App\Models\Games;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TemplateController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::id();


        $Game = Games::where([
            "gameid" => $request->game,
        ])->first()->id;


        Template::create([
            'user_id' => $user_id,
            'game_id' => $Game,
            'alias' => $request->alias,
            'uuid' => DB::raw('uuid()'),
        ]);

        session()->flash('success', '创建成功');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $user_id = Auth::id();
        $template_uuid = $request->template_uuid;

        $Template = Template::where([
            'user_id' => $user_id,
            'uuid' => $template_uuid,
        ])->first();

        $Template->delete();

        session()->flash('success', '删除成功');
        return redirect()->back();

    }
}