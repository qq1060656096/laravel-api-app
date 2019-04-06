<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-06
 * Time: 08:48
 */

namespace App\Transformer;



use App\User;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class UserDemoTransformer extends TransformerAbstract
{
    public function transform( $user){
        return [
            'user_name' => $user->name,
            'user_email' => $user->email,
        ];
    }
}