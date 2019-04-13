<?php
return [
    // 微信小程序配置验证
    'wx_applet_code' => [
        'verifier' => \App\OAuth2\Verifier\WxAppletWxCodeVerifier::class,
    ],
    'wx_qy_wx' => [

    ],
];