<?php

namespace App\Http\Controllers\Game;

use App\Models\Games;
use App\Models\PlugList;
use App\Models\PlugShop;
use App\Models\PlugStart;
use App\Models\Server;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function create($Gameid=null)
    {
        $user_id = Auth::id();

        $Game= Games::where([
            "gameid" => $Gameid,
        ])->first()->id;

        $Servers = Server::where([
            'user_id' => $user_id,
            'game_id' => $Game,
        ])->get();

        return view('game.base.index',['Servers'=> $Servers, 'game_id'=> $Gameid]);
    }
    public function delete(Request $request)
    {
        $server_uuid =  $request->server_uuid;
        $user_id = Auth::id();

        $Server = Server::where([
            'user_id' =>$user_id,
            'server_uuid'=> $server_uuid,
        ])->first();


        if($Server->delete())
            session()->flash('success', '删除成功!');
        return redirect()->back();
    }

    public function update(Request $request,$Gameid = null)
    {

        $server_uuid =  $request->server_uuid;
        $template_uuid =  $request->template_uuid;

        $user_id = Auth::id();
        $Game= Games::where([
            "gameid" => $Gameid,
        ])->first()->id;
        $Server = Server::where([
            'user_id' =>$user_id,
            'game_id' => $Game,
            'server_uuid'=> $server_uuid,
        ])->first();

        $Template = Template::where([
            'user_id' =>$user_id,
            'template_uuid' => $template_uuid
        ])->first();

        if(is_null($Template))
            $Server->template_id = null;
        else
            $Server->template_id = $Template->id;

        if($Server->save())
            session()->flash('success', '修改成功!');
        return redirect()->back();

    }

    public function database()
    {
        return view('game.base.database');
    }

    public function template($Gameid = null)
    {
        $Json =Array();
        $user_id = Auth::id();
        $Game = Games::where([
            'gameid' => $Gameid,
        ])->first();
        $plug_list = PlugList::where([
                'user_id' => Auth::id(),
                'game_id' => $Game->id,
            ]
        )->get();
        $template = Template::where(['user_id' => Auth::id(), 'game_id' => $Game->id])->get();


        //插件启用数量统计
        foreach ($template as $arr)
        {
            $count = PlugStart::where([
                'user_id' => $user_id,
                'template_uuid'=> $arr->template_uuid,
            ])->count();
            $arr = Arr::add($arr,'count_plug',$count);
            array_push($Json,$arr);
        }

        return view('game.base.template', ['templates' => $template, 'gameid' => $Gameid , "plug_list" => $plug_list]);
    }

    public function pluglist()
    {
        $plug_list = PlugList::where('user_id', Auth::id())->paginate(15);
        return view('game.base.plug_list', ['plug_list' => $plug_list]);
    }

    public function plugshop($Gameid = null)
    {
        $Game= Games::where([
            "gameid" =>$Gameid,
        ])->first()->id;

        $plug_shop = PlugShop::where('game_id', $Game)->paginate(10);
        return view('game.base.plug_shop', ['plug_shop' => $plug_shop]);
    }
    public function post_pluglist($Gameid = null)
    {
        if (is_null(cache('Game_Cache'))) {
            cache(['Game_Cache' =>$Gameid], 480);
        }
        return cache('Game_Cache');
    }

    public function categories()
    {
        if (is_null(cache('Game_Cache'))) {
            $Game = Games::all();

            cache(['Game_Cache' => $Game], 480);
        }
        return cache('Game_Cache');
    }



}

