<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
	public $auth_key;
	/**
	* @inheritdoc
	*/
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'is_active' => Yii::$app->params['IS_ACTIVE']['ACTIVE']]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

	//FIND USER BY EMAIL
    public static function findByEmail($email)
    {
        return User::findOne(['email' => $email, 'is_active' => Yii::$app->params['IS_ACTIVE']['ACTIVE']]);
    }

    //VALIDATE PASSWORD
    public static function validatePassword($email, $pass){
    	return User::findOne(['email' => $email, 'password'=> md5($pass), 'is_active' => Yii::$app->params['IS_ACTIVE']['ACTIVE']]);
    }
}