<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-10
 * Time: 21:16
 */

namespace App\OAuth2\Server\Grant\Dhb;

use RuntimeException;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Laravel\Passport\Bridge\User;

class DhbCodeGrantRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        $provider = config('auth.guards.api.provider');

        if (is_null($model = config("auth.providers.{$provider}.model"))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }

        if (method_exists($model, 'findCode')) {
            $user = (new $model)->findWxCode($username);
        }

        if (is_null($user)) {
            return;
        }
        return new User(10);
    }
}