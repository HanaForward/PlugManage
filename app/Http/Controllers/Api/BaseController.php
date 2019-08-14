<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    //
    public function info()
    {
        $user = Auth::id();
        return $user;
    }
    public function token()
    {
        return 'token无效或错误!';

    }
}
