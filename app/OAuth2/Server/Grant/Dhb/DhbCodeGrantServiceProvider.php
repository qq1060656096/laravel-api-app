<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-10
 * Time: 21:19
 */

namespace App\OAuth2\Server\Grant\Dhb;


use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;

class DhbCodeGrantServiceProvider extends ServiceProvider
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
        $grant = new DhbCodeGrant(
            $this->app->make(DhbCodeGrantRepository::class),
            $this->app->make(RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }
}