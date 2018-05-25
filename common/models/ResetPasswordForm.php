<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;

/**
 * ChangePasswordForm form
 */
class ResetPasswordForm extends Model {

    public $password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['password', 'confirm_password'], 'required'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'password' => Yii::t('app', 'New Password'),
            'confirm_password' => Yii::t('app', 'Repeat New Password'),
        );
    }

    /*
     *
     * Find User Details with token
     *
     */
    public function isResetTokenValid($token) {
        //GET USER'S DATA
        $usersData = ResetPasswordForm::getUsersDataByToken($token);
        if(isset($usersData->reset_token))
        {
            $dbToken = json_decode($usersData->reset_token)->token;
            //SECOND TIME VERIFY TOKEN
            if($dbToken === $token)
            {
                return true;
            }
        }
        return false;
    }

    //GET USER'S DATA BASED ON TOKEN
    static function getUsersDataByToken($token){
        //GET ID FROM TOKEN
        $userId = explode('#', base64_decode($token))[0];
        //GET USER'S DATA
        $userData = Users::findOne($userId);
        return $userData;
    }

}

?>