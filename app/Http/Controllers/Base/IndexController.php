<?php

namespace App\Http\Controllers\Base;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Games;


class IndexController extends Controller
{
    //

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $Games = Games::all();
        return view('base.index')
            ->with('user');
    }


}
