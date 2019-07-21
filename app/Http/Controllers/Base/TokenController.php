<?php

namespace App\Http\Controllers\Base;

use App\Models\Games;
use App\Models\Token;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TokenController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show()
    {
        $user = Auth::user();
        $Tokens = Token::all();
        return view('base.token')
            ->with('Tokens',$Tokens);
    }
    public function create(Request $request)
    {
        $credentials = $this->validate($request, [
            'alias' => 'required|string|max:30',
        ]);


        Token::create([
            'token' => Str::random(16),
            'alias' => $request->alias,
            'switch' => 1,
            'user_id' => 1,
        ]);

        $Tokens = Token::all();
        return view('base.token')
            ->with('Tokens',$Tokens);

    }
    public function delete(Request $request)
    {
        //$token = Token::where('token',$request->token)->get();
        $flag = Token::where('token',$request->Token)->delete();
        $Tokens = Token::all();
        if($flag)
            return redirect('token');
        else
            return redirect()->back();


    }

    public function update(Request $request)
    {

    }


}