<?php

namespace common\models\base;

use Yii;
use common\models\User;
use common\models\UserRules;

/**
 * This is the model class for table "user_roles".
*
    * @property integer $id
    * @property string $name
    * @property string $description
    * @property integer $is_active
    * @property string $created_at
    * @property string $updated_at
    *
            * @property User[] $users
            * @property UserRules[] $userRules
    */
class UserRolesBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_roles';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['name', 'description'], 'required'],
            [['is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'name' => 'Name',
    'description' => 'Description',
    'is_active' => 'Is Active',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsers()
    {
    return $this->hasMany(User::className(), ['user_role_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUserRules()
    {
    return $this->hasMany(UserRules::className(), ['user_role_id' => 'id']);
    }
}