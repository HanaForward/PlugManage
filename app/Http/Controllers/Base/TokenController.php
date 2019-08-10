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
        $user_id =  Auth::id();
        $Tokens = Token::where([
            'user_id' => $user_id,
        ])->get();
        return view('base.token')
            ->with('Tokens',$Tokens);
    }
    public function create(Request $request)
    {


       $user_id =  Auth::id();

        $credentials = $this->validate($request, [
            'alias' => 'required|string|max:30',
        ]);


        Token::create([
            'token' => Str::random(16),
            'alias' => $request->alias,
            'switch' => 1,
            'user_id' => $user_id,
        ]);


        return redirect('token');


    }
    public function delete(Request $request)
    {
        $user_id =  Auth::id();

        //$token = Token::where('token',$request->token)->get();
        $token = Token::where([
            'token' => $request->Token,
            'user_id' => $user_id,
        ])->first();

        if($token->delete())
            return redirect('token');
        else
            return redirect()->back();


    }

    public function update(Request $request)
    {

    }


}