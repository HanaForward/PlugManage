<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\PlugList;
use App\Models\PlugShop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function buy(Request $request)
    {
        $pay_channel = $request->pay_channel;

        $Plug = PlugShop::where('uuidShort',$request->uuid)->first();

        $exist = PlugList::where(['id' => $Plug->id,'user_id' => Auth::id()])->first();


        if($exist != null)
        {
            session()->flash('danger', '已被购买,无法重复购买!');
            return redirect()->back();
        }
        if($pay_channel == 1)
        {
            $User = User::find(Auth::id());
            $price = $Plug->price;
            $order = Order::create([
                'user_id' => $User->id,
                'plug_id' => $Plug->id,
                'price' => $price,
                'paytype' => $pay_channel,
                'state' =>false,
            ]);

            if($User->balance >= $price)
            {
                $User->balance -=  $price;
                if($User->save())
                {
                    $order->state = true;
                    $order->save();
                }

                PlugList::create([
                    'user_id' => $User->id,
                    'game_id' => $Plug->game_id,
                    'uuid' => DB::raw('uuid()'),
                    'plug_id' => $Plug->id,
                ]);
                session()->flash('success', '购买成功！');
                return redirect()->back();
            }
            else
            {
                session()->flash('danger', '金额不足,无法购买!');
                return redirect()->back();
            }
            return $Plug;
        }

        return $pay_channel;
    }
}
