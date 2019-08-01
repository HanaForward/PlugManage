<?php

namespace App\Http\Controllers\Game;

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
        Input::get();

        Template::create([
            'user_id' => Auth::id(),
            'game_id' => $request->game_id,
            'alias' => $request->alias,
            'uuid' => DB::raw('uuid()'),
        ]);

        session()->flash('success', '创建成功');
        return redirect()->back();
    }
}