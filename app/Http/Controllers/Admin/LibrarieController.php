<?php

namespace App\Http\Controllers\Admin;


use App\Models\LibrarieStorages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LibrarieController extends Controller
{
    public function show($Gameid = null)
    {
        $LibrariesStorage = DB::select("SELECT id,name,publickey,version,OCTET_LENGTH(data) datasize FROM librarie_storages");


        return view('admin.base.librarie',['Libraies'=> $LibrariesStorage,'gameid' => $Gameid]);

    }
    public function publish(Request $request)
    {

        $name = $request->name;
        $version = $request->version;
        $publickey = $request->publickey;
        if(is_null($publickey))
            $publickey="";



        $LibrarieStorages = LibrarieStorages::create([
            'name' => $name,
            'version' => $version,
            'publickey' => $publickey,
        ]);

        $file = $request->file('lib_data');
        $realPath = $file->getRealPath();
        $lib_data = base64_encode(fread(fopen($realPath, "r"), $file->getSize()));
        $LibrarieStorages->data = $lib_data;


        if ($LibrarieStorages->save()) {
            session()->flash('success', '发布成功');
            return redirect()->back();
        }

        session()->flash('danger', '发布失败');
        return redirect()->back();

    }

    public function updata(Request $request)
    {
        $ID = $request->id;
        $name = $request->name;

        $version = $request->version;


        $publickey = $request->publickey;
        if(is_null($publickey))
            $publickey="";

        $LibrarieStorages = LibrarieStorages::find($ID);

        $file = $request->file('lib_data');
        if(!is_null($file))
        {
            $realPath = $file->getRealPath();
            $lib_data = base64_encode(fread(fopen($realPath, "r"), $file->getSize()));
            $LibrarieStorages->data = $lib_data;
        }


        if($name != $LibrarieStorages->name)
        {
            $LibrarieStorages->name = $name;
        }
        if($version != $LibrarieStorages->version)
        {
            $LibrarieStorages->version = $version;
        }
        if($publickey != $LibrarieStorages->publickey)
        {
            $LibrarieStorages->publickey = $publickey;
        }


        if ($LibrarieStorages->save()) {
            session()->flash('success', '修改成功');
            return redirect()->back();
        }
        session()->flash('danger', '修改失败');
        return redirect()->back();



    }

}
