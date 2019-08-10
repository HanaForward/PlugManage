<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    public function show()
    {

    }


    public function create(Request $request)
    {
        $user= Auth::user();
        $this->authorize('update', $user);

    }
}
