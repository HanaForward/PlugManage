<?php

namespace App\Http\Controllers\Base;

use App\Models\Games;
use App\Models\PlugList;
use App\Models\PlugShop;
use App\Models\PlugStart;
use App\Models\Server;
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

    public function update(Request $request)
    {
        $user_id = Auth::id();
        $data = $request->data;
        $data = json_decode($data);

        foreach ($data  as $Arr)
        {
            if($Arr->switch && !is_null($Arr->switch))
            {
                $flag = true;
                $Plug = PlugList::where([
                    'user_id'=> $user_id,
                    'uuid'=>$Arr->uuid,
                ])->first();
                if(!is_null($Plug))
                {

                    $PlugStart =  PlugStart::where([
                        'template_uuid' =>$request->template_uuid,
                        'user_id'=> $user_id,
                        'plug' => $Plug->plug_id,
                    ])->first();
                    if(is_null($PlugStart))
                    {
                        PlugStart::create([
                            'template_uuid' =>$request->template_uuid,
                            'user_id'=> $user_id,
                            'plug' => $Plug->plug_id,
                            'switch' => 1,
                        ]);
                    }


                }
            }
            else
            {

                $Plug = PlugList::where([
                    'user_id'=> $user_id,
                    'uuid'=>$Arr->uuid,
                ])->first();

                $PlugStart =  PlugStart::where([
                    'template_uuid' =>$request->template_uuid,
                    'user_id'=> $user_id,
                    'plug' => $Plug->plug_id,
                ])->first();
                if(!is_null($PlugStart))
                    $PlugStart->delete();

            }

        }


        return $data;
    }

    public function get_templates(Request $request){
        $user_id = Auth::id();
        $game_id = $request->game_id;

        $game= Games::where([
            "gameid" => $game_id,
        ])->first()->id;


        $Template = Template::where([
            'user_id' => $user_id,
            'game_id' => $game,
        ])->get();

        return $Template;
    }

    public function set_templates(Request $request){
        $user_id = Auth::id();
        $uuid = $request->uuid;
        $server_uuid =  $request->server_uuid;


        $Server = Server::where([
            'server_uuid' => $server_uuid,
            'user_id' => $user_id,
        ])->first();

        $Template = Template::where([
            'user_id' => $user_id,
            'uuid' => $uuid,
        ])->get();

        return ;
    }

    public function show(Request $request){

        $user_id = Auth::id();
        $PlugStart = DB::select("SELECT * FROM plug_lists LEFT JOIN (SELECT * FROM plug_starts WHERE user_id=".$user_id." and template_uuid = '".$request->template_uuid . "') as plug_starts ON plug_starts.plug = plug_lists.id WHERE plug_lists.user_id=".$user_id);
        $Array = array();
        foreach ($PlugStart  as $Arr)
        {
            if($Arr->switch && !is_null($Arr->switch))
                $flag = true;
            else
                $flag = false;

            $Plug = PlugShop::find($Arr->plug_id);
            $new_array = array([
                'uuid' => $Arr->uuid,
                'name' =>$Plug->name,
                'switch' => $flag,

            ]);
            $Array = array_merge_recursive($Array,$new_array);
        }
        return $Array;
    }


}