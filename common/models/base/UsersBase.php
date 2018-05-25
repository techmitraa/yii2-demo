<?php

namespace common\models\base;

use Yii;
use common\models\UserRoles;

/**
 * This is the model class for table "users".
*
    * @property string $id
    * @property integer $user_role_id
    * @property string $first_name
    * @property string $last_name
    * @property string $email
    * @property string $password
    * @property string $dob
    * @property integer $gender
    * @property string $street_address
    * @property integer $city_id
    * @property integer $state_id
    * @property string $zipcode
    * @property integer $country_id
    * @property string $mobile_number
    * @property string $profile_pic
    * @property string $reset_token
    * @property integer $is_seller
    * @property integer $is_newsletter_subscribed
    * @property integer $is_active
    * @property string $created_at
    * @property string $updated_at
    *
            * @property UserRoles $userRole
    */
class UsersBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'users';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['user_role_id', 'first_name', 'last_name', 'email', 'password', 'dob', 'gender', 'street_address', 'city_id', 'state_id', 'zipcode', 'country_id', 'mobile_number', 'profile_pic'], 'required'],
            [['user_role_id', 'gender', 'city_id', 'state_id', 'country_id', 'is_seller', 'is_newsletter_subscribed', 'is_active'], 'integer'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['reset_token'], 'string'],
            [['first_name', 'last_name', 'email', 'password', 'street_address', 'zipcode', 'mobile_number', 'profile_pic'], 'string', 'max' => 255],
            [['user_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRoles::className(), 'targetAttribute' => ['user_role_id' => 'id']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'user_role_id' => 'User Role ID',
    'first_name' => 'First Name',
    'last_name' => 'Last Name',
    'email' => 'Email',
    'password' => 'Password',
    'dob' => 'Dob',
    'gender' => 'Gender',
    'street_address' => 'Street Address',
    'city_id' => 'City ID',
    'state_id' => 'State ID',
    'zipcode' => 'Zipcode',
    'country_id' => 'Country ID',
    'mobile_number' => 'Mobile Number',
    'profile_pic' => 'Profile Pic',
    'reset_token' => 'Reset Token',
    'is_seller' => 'Is Seller',
    'is_newsletter_subscribed' => 'Is Newsletter Subscribed',
    'is_active' => 'Is Active',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUserRole()
    {
    return $this->hasOne(UserRoles::className(), ['id' => 'user_role_id']);
    }
}