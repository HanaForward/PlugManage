<?php

namespace App\Providers;

use App\Models\PlugShop;
use App\Models\Token;
use App\Models\User;
use App\Policies\ShopPolicy;
use App\Policies\TokenPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 应用的策略映射。
     *
     * @var array
     */
    protected $policies = [
        PlugShop::class => ShopPolicy::class,
        User::class=> UserPolicy::class,
        Token::class=>TokenPolicy::class,
    ];

    /**
     * 注册任意应用认证、应用授权服务
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        //
    }
}
