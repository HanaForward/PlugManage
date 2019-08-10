<?php

namespace App\Http\Controllers\Api\Game;

use App\Models\Games;
use App\Models\PlugList;
use App\Models\PlugShop;
use App\Models\PlugStart;
use App\Models\PlugStorage;
use App\Models\Server;
use App\Models\Template;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Array_;

class Game_304930 extends Controller
{

    public function login(Request $request,$gameid = null)
    {


        $Game = Games::where([
            'gameid' => $gameid
        ])->first();


        $Json =Array();

        $user_id = Auth::id();
        $uuid = $request->UUID;

        $Template_Id = null;
        $Plug = Array();

        if (!is_null($uuid)) {
            $Server = Server::where([
                'user_id' => $user_id,
                'server_uuid' => $uuid,
            ])->first();

            if (!is_null($Server)) {
                $Template = Template::find($Server->template_id);

                if (!is_null($Template)) {

                    $Template_Id = $Template->template_uuid; //添加模板ID


                    //$Json = Arr::add($Json,'Template',$Server->template_uuid);

                    $PlugStart = PlugStart::where([
                        'user_id' => $user_id,
                        'template_uuid' => $Template->template_uuid,
                    ])->get();

                    if(!is_null($PlugStart))
                    {
                        //$Plug =  $PlugStart;

                        foreach ($PlugStart as $arr)
                        {
                            $data = array();
                            $plug = $arr->plug();

                            $data = Arr::add($data,'uuidShort',$plug->uuidShort);
                            $data = Arr::add($data,'name',$plug->name);
                            $data = Arr::add($data,'switch',$arr->switch);

                            array_push($Plug,$data);
                        }
                    }
                }
            } else {
                $Server = Server::create([
                    'user_id' => $user_id,
                    'server_uuid' => $uuid,
                    'game_id' => $Game->id,
                ]);
            }
        } else {
            $uuid = DB::select("select uuid()")[0]->{'uuid()'};
        }

        $Json = Arr::add($Json,'Token',$request->token);
        $Json = Arr::add($Json,'UUID',$uuid);
        $Json = Arr::add($Json,'Template',$Template_Id);
        $Json = Arr::add($Json,'Plug',$Plug);

        return $Json;
    }

    public function GetPlug(Request $request)
    {
        $user_id = Auth::id();
        $uuidShort = $request->uuidShort;
        $version = $request->version;


       $PlugShop = PlugShop::where([
            'uuidShort' => $uuidShort,
        ])->first();

        if(is_null($PlugShop))
        {
            return json_decode("无效的uuidShort");
        }

        $Plug_Id = $PlugShop->id;

        $PlugList = PlugList::where([
            'plug_id' => $Plug_Id,
            'user_id' =>$user_id,
        ])->first();
        if(is_null($PlugList))
        {
            return json_decode("检测到越权访问,已记录!");
        }

        if(is_null($version))
            $version = "";

        $PlugData = PlugStorage::where([
            'plug_id' => $Plug_Id,
        ])->first();

        $Data = $PlugData->data;


        $filename = $PlugShop->name.".dll";
        $headers = [
            'Content-Encoding' => 'UTF-8',
            'Content-Type' => 'application/x-msdownload',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];


        response()->stream(function () use ($Data) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, $Data);

            // Close the output stream
            fclose($handle);
        }, 200, $headers)->send();

    }
}
