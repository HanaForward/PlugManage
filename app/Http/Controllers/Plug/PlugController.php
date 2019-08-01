<?php

namespace App\Http\Controllers\Plug;

use App\Models\PlugList;
use App\Models\PlugShop;
use App\Models\PlugStart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlugController extends Controller
{



    public function pluglist(Request $request){

        $user_id = Auth::id();
        $PlugStart = DB::select("SELECT * FROM plug_lists LEFT JOIN (SELECT * FROM plug_starts WHERE user_id=".$user_id." and template_uuid = '".$request->template_uuid . "') as plug_starts ON plug_starts.plug = plug_lists.id WHERE plug_lists.user_id=".$user_id);

        /*
        $PlugStart = PlugStart::rightJoin('plug_lists','plug_lists.id','plug_starts.plug')
            ->where([
                'plug_lists.user_id' => Auth::id(),
                'template_uuid' => $request->template_uuid ,
            ])
            ->select('plug_starts.*','plug_lists.*')
            ->get();
        */

        $Array = array();
        foreach ($PlugStart  as $Arr)
        {
            if($Arr->switch && !is_null($Arr))
                $flag = true;
            else
                $flag = false;

            $Plug = PlugShop::find($Arr->plug_id);
            $new_array = array([
                'uuidShort' => $Plug->uuidShort,
                'name' =>$Plug->name,
                'switch' => $flag,

            ]);
            $Array = array_merge_recursive($Array,$new_array);
        }


        return $Array;


        return response()->json($PlugStart->toArray());
    }
}
