<?php

namespace App\Http\Controllers\API\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlugManage extends Controller
{
    public function GetPlugs()
    {
        Auth::user();







    }
}
