<?php
/**
 * Created by PhpStorm.
 * User: hubeiwei
 * Date: 2016/7/28
 * Time: 18:17
 * To change this template use File | Settings | File Templates.
 */

/**
 * Used for enhanced IDE code auto-completion.
 */
class Yii
{
    /**
     * @var MyApplication
     */
    public static $app;
}

/**
 * @property User $user
 */
abstract class MyApplication
{
    /**
     * @return User
     */
    abstract public function getUser();
}

/**
 * @property \app\models\User $identity
 */
abstract class User
{
    /**
     * @return \app\models\User
     */
    abstract public function getIdentity();
}
