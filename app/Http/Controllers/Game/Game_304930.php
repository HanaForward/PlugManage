<?php

namespace App\Http\Controllers\Game;

use App\Models\Games;
use App\Models\PlugList;
use App\Models\PlugShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Game_304930 extends Controller
{

    private $Game = 304930;
    private $Game_Id = 1;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        return view('game.'  .  $this->Game  . '.index');
    }

    public function database()
    {
        return view('game.'  .  $this->Game  . '.database');
    }
    public function template()
    {
        return view('game.'  .  $this->Game  . '.template');
    }

    public function pluglist()
    {
        //$plug_list =PlugList::where('user_id',Auth::id())->->paginate(10)(10)->comments();
        $plug_list =PlugList::where('user_id',Auth::id())->paginate(15);
        return view('game.'  .  $this->Game  . '.plug_list',['plug_list' => $plug_list]);
    }
    public function plugshop()
    {
        $plug_shop =PlugShop::where('game',$this->Game_Id)->paginate(10);
        return view('game.'  .  $this->Game  . '.plug_shop',['plug_shop' => $plug_shop]);
    }


    public function categories()
    {
        if (is_null(cache('Game_Cache'))) {
            cache(['Game_Cache' => $this->Game], 480);
        }
        return cache('Game_Cache');
    }



}
