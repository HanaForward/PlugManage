<?php

namespace App\Http\Controllers\Admin;


use App\Models\Games;
use App\Models\PlugShop;
use App\Models\PlugStorage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlugController extends Controller
{

    /**
     * 更新权限浏览页面。
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $this->authorize('update', $user);
    }

    public function show(Request $request, $Gameid = null)
    {
        $user_id = Auth::id();
        $Game = Games::where([
            "gameid" => $Gameid,
        ])->first()->id;
        $Plugs = PlugShop::where([
            'user_id' => $user_id,
            'game_id' => $Game,
        ])->paginate(15);
        return view('admin.base.plug', ['Plugs' => $Plugs, 'game_id' => $Gameid]);
    }


    public function publish(Request $request, $Gameid = null)
    {
        $user_id = Auth::id();
        $Game = Games::where([
            "gameid" => $Gameid,
        ])->first()->id;

        $Plug_Name = $request->name;
        $Plug_Price = $request->price;
        $Plug_Description = $request->description;
        $file = $request->file('plug_data');

        $realPath = $file->getRealPath();


        $PlugShop = PlugShop::create([
            'user_id' => $user_id,
            'game_id' => $Game,
            'uuidShort' => DB::raw('left(uuid(),8)'),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);


        $plug_data = base64_encode(fread(fopen($realPath, "r"), $file->getSize()));

        PlugStorage::create([
            'plug_id' => $PlugShop->id,
            'user_id' => $user_id,
            'version' => 'releases',
            'data' => $plug_data,
        ]);
        return redirect()->back();

    }

    public function updata(Request $request, $Gameid = null)
    {
        $user_id = Auth::id();
        $Game = Games::where([
            "gameid" => $Gameid,
        ])->first()->id;

        $PlugShop = PlugShop::where([
            'user_id' => $user_id,
            'uuidShort' => $request->uuidShort,
        ])->first();


        $PlugShop->name = $request->name;
        $PlugShop->price = $request->price;
        $PlugShop->description = $request->description;

        if ($PlugShop->save()) {
            session()->flash('success', '修改成功');
            return redirect()->back();
        }
        session()->flash('danger', '修改失败');
        return redirect()->back();


    }
}
