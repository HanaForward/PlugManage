<?php

namespace App\Http\Controllers\Game;

use App\Models\Games;
use App\Models\PlugList;
use App\Models\PlugShop;
use App\Models\PlugStart;
use App\Models\Server;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Yansongda\LaravelPay\Facades\Pay;


class Game_304930 extends Controller
{

    private $Game = 304930;

    public function create()
    {
        $user_id = Auth::id();

        $Game= Games::where([
            "gameid" => $this->Game,
        ])->first()->id;

        $Servers = Server::where([
            'user_id' => $user_id,
            'game_id' => $Game,
        ])->get();



        return view('game.' . $this->Game . '.index',['Servers'=> $Servers]);
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

    public function update(Request $request)
    {

        $server_uuid =  $request->server_uuid;
        $template_uuid =  $request->template_uuid;

        $user_id = Auth::id();

        $Game= Games::where([
            "gameid" => $this->Game,
        ])->first()->id;
         $Server = Server::where([
             'user_id' =>$user_id,
             'game_id' => $Game,
             'server_uuid'=> $server_uuid,

         ])->first();

         $Template = Template::where([
             'user_id' =>$user_id,
             'uuid' => $template_uuid
         ])->first();
        $Server->template_id = $Template->id;
        if($Server->save())
             session()->flash('success', '修改成功!');
        return redirect()->back();

    }

    public function database()
    {
        return view('game.' . $this->Game . '.database');
    }

    public function template()
    {

        $Json =Array();
        $user_id = Auth::id();

        $Game = Games::where([
            'gameid' => $this->Game,
        ])->first();


        $plug_list = PlugList::where([
                'user_id' => Auth::id(),
                'game_id' => $Game->id,
            ]
        )->get();



        $template = Template::where(['user_id' => Auth::id(), 'game_id' => $Game->id])->get();

        foreach ($template as $arr)
        {

            $count = PlugStart::where([
                'user_id' => $user_id,
                'template_uuid'=> $arr->uuid,
            ])->count();

            $arr = Arr::add($arr,'count_plug',$count);

            array_push($Json,$arr);
        }

        return view('game.' . $this->Game . '.template', ['templates' => $template, 'game' => $this->Game , "plug_list" => $plug_list]);
    }

    public function pluglist()
    {
        //$plug_list =PlugList::where('user_id',Auth::id())->->paginate(10)(10)->comments();
        $plug_list = PlugList::where('user_id', Auth::id())->paginate(15);
        return view('game.' . $this->Game . '.plug_list', ['plug_list' => $plug_list]);
    }

    public function plugshop()
    {
        $Game= Games::where([
            "gameid" => $this->Game,
        ])->first()->id;

        $plug_shop = PlugShop::where('game_id', $Game)->paginate(10);
        return view('game.' . $this->Game . '.plug_shop', ['plug_shop' => $plug_shop]);
    }

    public function categories()
    {
        if (is_null(cache('Game_Cache'))) {
            cache(['Game_Cache' => $this->Game], 480);
        }
        return cache('Game_Cache');
    }
    public function post_pluglist()
    {
        if (is_null(cache('Game_Cache'))) {
            cache(['Game_Cache' => $this->Game], 480);
        }
        return cache('Game_Cache');
    }



}
