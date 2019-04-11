<?php

namespace App;

use App\Exceptions\OAuth2Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findWxCode($code)
    {
        if (!$code) {
            OAuth2Exception::wxCodeOpenIdNotFound();
        }
        $user = new User();
        $user->id = 10;
        return $user;
    }

    public function getAuthIdentifier()
    {
        return 10;
    }
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        var_dump(__METHOD__, $credentials);exit;
    }
}
