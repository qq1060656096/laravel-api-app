<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-09
 * Time: 22:53
 */

namespace App\OAuth2\Server\Verify;

use League\OAuth2\Server\Grant\AbstractGrant;

/**
 * code方式验证
 * Interface CodeVerifierInterface
 * @package App\OAuth2\Server\Verify
 */
interface CodeGrantVerifierInterface
{
    /**
     * 授权验证
     * @param AbstractGrant $grantInstance 授权类型
     * @param string $code
     * @return string|int
     */
    public function verify(AbstractGrant $grantInstance, $code);
}