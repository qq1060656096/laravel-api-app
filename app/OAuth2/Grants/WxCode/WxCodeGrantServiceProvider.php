<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-10
 * Time: 21:19
 */

namespace App\OAuth2\Grants\WxCode;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;

/**
 * 自定义授权提供者
 * Class CustomAuthGrantServiceProvider
 * @package App\OAuth2\Server\Grant\Dhb
 */
class WxCodeGrantServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->resolving(AuthorizationServer::class, function ($server, $app) {
            $server->enableGrantType(
                $this->makeDhbCodeGrant(), Passport::tokensExpireIn()
            );
        });
    }

    protected function makeDhbCodeGrant()
    {
        $grant = new WxCodeAuthGrant(
            $this->app->make(WxCodeAuthUserRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }
}