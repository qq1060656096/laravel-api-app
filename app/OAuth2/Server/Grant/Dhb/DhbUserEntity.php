<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-10
 * Time: 21:34
 */

namespace App\OAuth2\Server\Grant\Dhb;


use League\OAuth2\Server\Entities\UserEntityInterface;

class DhbUserEntity implements UserEntityInterface
{
    /**
     * Return the user's identifier.
     *
     * @return mixed
     */
    public function getIdentifier()
    {

    }
}