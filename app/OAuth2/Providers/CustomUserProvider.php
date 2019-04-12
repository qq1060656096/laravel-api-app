<?php

namespace App\OAuth2\Providers;

use App\OAuth2\Grants\Custom\CustomAuthUserRepository;
use App\OAuth2\Helper\AuthHelper;
use App\OAuth2\Helper\JwtDecoderHelper;
use App\OAuth2\Users\CustomAuthUser;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomUserProvider implements UserProvider
{
    protected $table = "oauth_access_tokens";

    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $model
     * @return void
     */
    public function __construct()
    {
        $this->hasher = null;
        $this->token = null;
    }

    /**
     * 检索用户信息
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $tokenModel = new Token();
        $obj = new CustomAuthUser();
        $obj->setAuthIdentifier($identifier);
        return $obj;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
        return null;
    }

    /**
     * 根据凭证获取用户信息
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {

        if ( !isset($credentials['api_token'])) {
            return null;
        }
        $jwtToken = $credentials['api_token'];
        $jwtDecodeArray = JwtDecoderHelper::decode($jwtToken);
        JwtDecoderHelper::checkExpired($jwtDecodeArray);
        $identifier = JwtDecoderHelper::getUserIdentifier($jwtDecodeArray);
        $obj = new CustomAuthUser();
        $obj->setAuthIdentifier($identifier);
        return $obj;
    }

    /**
     * 验证解锁用户凭证
     *
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {

        if (!isset($credentials['api_token'])) {
            return false;
        }
        return true;
    }

    /**
     * Get the generic user.
     *
     * @param  mixed  $user
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getGenericUser($user)
    {
        if (! is_null($user)) {
            return new GenericUser((array) $user);
        }
    }
}
