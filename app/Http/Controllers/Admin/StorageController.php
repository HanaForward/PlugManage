<?php

namespace App\Http\Controllers\Admin;

use App\Models\Games;
use App\Models\PlugShop;
use App\Models\PlugStorage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{

    public function show($Gameid = null)
    {
        $user_id = Auth::id();
        $game_id = Games::where([
            'gameid' => $Gameid,
        ])->first();

        PlugShop::where([
            'user_id' => $user_id,
            'game_id' =>$game_id,
        ])->get();

        $Plugs = DB::select("SELECT * FROM plug_shops LEFT JOIN (SELECT plug_id,version FROM plug_storages WHERE user_id=".$user_id.") as plug_storages ON plug_shops.id = plug_storages.plug_id WHERE plug_shops.user_id=".$user_id);

        return view('admin.base.storage',['Plugs'=> $Plugs,'gameid' => $Gameid]);
    }

    public function updata(Request $request)
    {
        $user_id = Auth::id();




        $PlugShop = PlugShop::where([
            'user_id' =>$user_id,
            'uuidShort'=>$request->plug_uuid,
        ])->first();

        if(is_null($PlugShop))
        {
            return redirect()->back();
        }

        $file = $request->file('data');

        $realPath = $file->getRealPath();
        $plug_data = base64_encode(fread(fopen($realPath, "r"), $file->getSize()));



        $PlugStorage = PlugStorage::where([
            'user_id' =>$user_id,
            'plug_id' =>$PlugShop->id,
        ])->first();


        if(is_null($PlugStorage))
        {
            PlugStorage::create([
                'user_id' =>$user_id,
                'plug_id' =>$PlugShop->id,
                'version' =>'releases',
                'data' =>$plug_data,
            ]);
        }
        else
        {
            $PlugStorage->data =$plug_data;
            $PlugStorage->save();
        }

        return redirect()->back();
    }
}
