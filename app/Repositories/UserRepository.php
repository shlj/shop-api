<?php
/**
 * Created by PhpStorm.
 * User: hwang
 * Date: 2016/1/28
 * Time: 14:54
 */

namespace App\Repositories;

use App\Exceptions\Exception;
use App\Models\BJ\SupermarketAdmin;
use App\Models\NJ\SupermarketAdmin as SupermarketAdminNJ;
use App\Models\NJ\Supermarket;
use App\Models\UserModel;
use App\Users\HMUser;
use App\Users\User;

class UserRepository
{

    /**
     * 统一登录入口.
     * @param $name
     * @return User
     * @throws Exception
     */
    public static function loginEntry($name, $platform = '')
    {
        if($user = self::getUserFromDB($name)){
            return $user;
        }

        throw new Exception('user.notExist', '用户不存在');
    }

    /**
     * @param $mobile
     * @return User
     * @throws Exception
     */
    public static function getUserFromDB($mobile)
    {
        //查询用户基础信息
        $userInfo = UserModel::where('m.status',1)
            ->leftJoin('shop_member as m','m.user_id', '=', 'shop_user.id')
            ->first();

        if(is_null($userInfo)) {
            throw new Exception('user.notExisted','用户不存在');
        }

        $user = new User();
        $user->username = $mobile;
        $user->pass = $userInfo->password;
        
        return $user;
    }
}