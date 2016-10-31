<?php
/**
 * Created by PhpStorm.
 * User: songhang
 * Date: 16-10-28
 * Time: 下午8:50
 */

namespace App\Users;


use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User implements 
    Authenticatable,
    JWTSubject
{
    public $username;
    
    public $pass;

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->primaryKey};
    }


    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->pass;
    }

    /**
     * Get the token value for the "remember me" session.
     * 
     * @throws NotSupportedException
     */
    public function getRememberToken()
    {
        throw new NotSupportedException();
    }

    /**
     * Set the token value for the "remember me" session.
     * 
     * @param string $value
     * @throws NotSupportedException
     */
    public function setRememberToken($value)
    {
        throw new NotSupportedException();
    }

    /**
     * Get the column name for the "remember me" token.
     * 
     * @throws NotSupportedException
     */
    public function getRememberTokenName()
    {
        throw new NotSupportedException();
    }
    
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
    }
    
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [
            'sub' => $this->username,
        ];
    }
}