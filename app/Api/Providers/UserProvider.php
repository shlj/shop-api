<?php
/**
 * Created by PhpStorm.
 * User: hwang
 * Date: 2016/1/28
 * Time: 13:02
 */

namespace app\Api\Providers;

use App\Exceptions\Exception;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as UserProviderContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserProvider implements UserProviderContract
{
    /**
     * @var UserRepository
     */
    private $userRep;

    public function __construct(UserRepository $userRep)
    {
        $this->userRep = $userRep;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $user = $this->userRep->loginEntry($identifier);
        return $user;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed   $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        throw new Exception();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new Exception();
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = $this->userRep->loginEntry($credentials['username']);

        return $user;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if(isset($credentials['code'])&&$credentials['code']){
            return true;
        }
        $plain = $credentials['password'];

        $passMd5Upper = strtoupper(md5($plain));

        return $passMd5Upper == strtoupper($user->getAuthPassword());
    }
}