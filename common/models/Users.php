<?php

namespace common\models;

class Users extends \common\models\base\UsersBase
{
	//BEFORE SAVE ACTION
	public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {
            $this->created_at = date('Y-m-d H:i:s');
            $this->password = md5($this->password); 
        }
        else
        {
        	$this->updated_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
    /**
* @inheritdoc
*/
	public function rules()
	{
	        return [
	            [['user_role_id', 'first_name', 'last_name', 'email', 'dob', 'gender', 'street_address', 'state_id', 'zipcode', 'country_id', 'mobile_number'], 'required'],
	            [['email'], 'email'],
	            [['user_role_id', 'gender', 'city_id', 'state_id', 'country_id', 'is_seller', 'is_newsletter_subscribed', 'is_active'], 'integer'],
	            [['dob', 'created_at', 'updated_at'], 'safe'],
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
		    'user_role_id' => 'User Role',
		    'first_name' => 'First Name',
		    'last_name' => 'Last Name',
		    'email' => 'Email',
		    'password' => 'Password',
		    'dob' => 'Dob',
		    'gender' => 'Gender',
		    'street_address' => 'Street Address',
		    'city_id' => 'City',
		    'state_id' => 'State',
		    'zipcode' => 'Zipcode',
		    'country_id' => 'Country',
		    'mobile_number' => 'Mobile Number',
		    'profile_pic' => 'Profile Pic',
		    'is_seller' => 'Is Seller',
		    'is_newsletter_subscribed' => 'Is Newsletter Subscribed',
		    'is_active' => 'Is Active',
		    'created_at' => 'Created At',
		    'updated_at' => 'Updated At',
		];
	}
}