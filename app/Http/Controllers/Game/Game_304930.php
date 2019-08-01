<?php

namespace App\Http\Controllers\Game;

use App\Models\Games;
use App\Models\PlugList;
use App\Models\PlugShop;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yansongda\LaravelPay\Facades\Pay;


class Game_304930 extends Controller
{

    private $Game = 304930;
    private $Game_Id;

    public function __construct()
    {
        $this->Game_Id = 1;
    }


    public function create()
    {
        return view('game.' . $this->Game . '.index');
    }

    public function database()
    {
        return view('game.' . $this->Game . '.database');
    }

    public function template()
    {
        $plug_list = PlugList::where([
                'user_id' => Auth::id(),
                'game_id' =>$this->Game_Id,
            ]
        )->get();


        $template = Template::where(['user_id' => Auth::id(), 'game_id' => $this->Game_Id])->get();
        return view('game.' . $this->Game . '.template', ['templates' => $template, 'game_id' => $this->Game_Id , "plug_list" => $plug_list]);
    }

    public function pluglist()
    {
        //$plug_list =PlugList::where('user_id',Auth::id())->->paginate(10)(10)->comments();
        $plug_list = PlugList::where('user_id', Auth::id())->paginate(15);
        return view('game.' . $this->Game . '.plug_list', ['plug_list' => $plug_list]);
    }

    public function plugshop()
    {
        $plug_shop = PlugShop::where('game_id', $this->Game_Id)->paginate(10);
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
