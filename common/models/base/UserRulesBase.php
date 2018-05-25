<?php

namespace common\models\base;

use Yii;
use common\models\UserRoles;
use common\models\UserRulesMenu;

/**
 * This is the model class for table "user_rules".
*
    * @property integer $id
    * @property integer $user_role_id
    * @property string $permitted_controller
    * @property string $permitted_actions
    * @property string $permit_type
    * @property integer $is_permitted
    * @property string $created_at
    * @property string $updated_at
    *
            * @property UserRoles $userRole
            * @property UserRulesMenu[] $userRulesMenus
    */
class UserRulesBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_rules';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['user_role_id', 'permitted_controller', 'permitted_actions', 'permit_type', 'is_permitted'], 'required'],
            [['user_role_id', 'is_permitted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['permitted_controller', 'permitted_actions', 'permit_type'], 'string', 'max' => 255],
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
    'permitted_controller' => 'Permitted Controller',
    'permitted_actions' => 'Permitted Actions',
    'permit_type' => 'Permit Type',
    'is_permitted' => 'Is Permitted',
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

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUserRulesMenus()
    {
    return $this->hasMany(UserRulesMenu::className(), ['user_rule_id' => 'id']);
    }
}